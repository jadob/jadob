<?php
declare(strict_types=1);

namespace Jadob\Objectable;

use Countable;
use DateTime;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Jadob\Objectable\Annotation\ActionField;
use Jadob\Objectable\Annotation\Header;
use Jadob\Objectable\Annotation\Row;
use Jadob\Objectable\Renderer\PhpTemplateRenderer;
use Jadob\Objectable\Transformer\ActionFieldTransformerInterface;
use Jadob\Objectable\Transformer\HeaderTransformerInterface;
use Jadob\Objectable\Transformer\ValueTransformerInterface;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use function count;
use function htmlentities;
use function is_array;

/**
 * @deprecated
 * @author pizzaminded <miki@calorietool.com>
 * @license MIT
 */
class Objectable
{
    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var HeaderTransformerInterface
     */
    protected $headerTransformer;

    /**
     * @var AnnotationReader
     */
    protected $annotationReader;

    /**
     * @var ActionFieldTransformerInterface
     */
    protected $actionFieldTransformer;

    /**
     * @var PhpTemplateRenderer
     */
    protected $renderer;

    /**
     * @var ValueTransformerInterface[]
     */
    protected $valueTransformers = [];

    /**
     * @param Reader $annotationReader
     * @param ActionFieldTransformerInterface|null $actionFieldTransformer
     * @param HeaderTransformerInterface|null $headerTransformer
     */
    public function __construct(
        Reader $annotationReader,
        ?ActionFieldTransformerInterface $actionFieldTransformer = null,
        ?HeaderTransformerInterface $headerTransformer = null
    ) {
        $this->configuration = [
            /**
             * Enable sorting
             */
            'header_sorting' => false,

            /**
             * Values that would be passed to GET parameters
             */
            'sorting_asc_phrase' => 'asc',
            'sorting_desc_phrase' => 'desc',

            /**
             * Experimental.
             *
             * Allows to sort by one than more column at a time.
             * Parameters will be passed as an array in GET:
             * &sort[name]=desc&sort[id]=asc
             *
             * If false, current sorting result will be reset for each request.
             */
            'chained_sorting' => false,


            /**
             * These things are used only by default value transformer. It wont apply if there are at least one transformer passed
             */
            'datetime_format' => 'Y-m-d H:i:s', //default datetime format
            'null_format' => '<span class="badge badge-info">Null</span>', //default value which will be shown if property === null,
            'true_format' => '<span class="badge badge-success">True</span>', //for boolean true
            'false_format' => '<span class="badge badge-danger">False</span>', //for boolean false

        ];

        $this->renderer = new PhpTemplateRenderer();

        $this->actionFieldTransformer = $actionFieldTransformer;
        $this->headerTransformer = $headerTransformer;

        $this->annotationReader = $annotationReader;
        if (!$annotationReader instanceof Reader) {
            $this->annotationReader = new AnnotationReader();
        }
    }

    /**
     * @param array|Countable $data
     * @return string
     * @throws ObjectableException
     * @throws ReflectionException
     */
    public function renderTable($data): string
    {
        if (!is_iterable($data)) {
            throw new ObjectableException('Passed $data is not iterable');
        }

        if (count($data) === 0) {
            return $this->renderer->renderNoResultsTemplate();
        }

        $propertyAccessor = PropertyAccess::createPropertyAccessor();
        $firstElementFetched = false;
        $class = null;
        $index = 0;
        $rows = [];

        /**
         * @deprecated
         */
        $headers = [];
        /**
         * @deprecated
         */
        $propertiesToExtract = [];
        /**
         * @deprecated
         */
        $actionFields = [];

        foreach ($data as $element) {
            $cellIndex = 0;
            $row = [];

            if (!$firstElementFetched) {
                $firstElementFetched = true;
                $class = $element::class;
                $rowMetadata = $this->extractRowMetadata($element);
                $headers = $rowMetadata->getHeaders();
                $actionFields = $rowMetadata->getActionFields();
                $propertiesToExtract = $rowMetadata->getPropertiesToExtract();
            }

            //extract all things in object
            foreach ($propertiesToExtract as $property) {
                /**
                 * TODO:
                 * - if there is "getter" property in header, use them
                 */
                $value = $propertyAccessor->getValue($element, $property);
                //transform value
                $row[$cellIndex++] = $this->transformValue($value, $class, $property);
                unset($value);
            }

            //rendering action fields
            //TODO: move to separate method
            if (count($actionFields) > 0) {
                $renderedActionFields = '';

                foreach ($actionFields as $actionField) {
                    $renderedField = $this->renderer->renderActionField(
                        $this->actionFieldTransformer->transformActionLabel($actionField, $element),
                        $actionField->name,
                        $this->actionFieldTransformer->transformActionUrl($actionField, $element)
                    );

                    $renderedActionFields .= $renderedField;
                }

                $row[$cellIndex] = $renderedActionFields;
            }

            $rows[$index] = $row;
            $index++;
        }

        $headerTitles = [];

        foreach ($headers as $propertyName => $headerAnnotation) {
            $title = $headerAnnotation->getTitle();
            if ($this->headerTransformer !== null) {
                $title = $this->headerTransformer->transform($title, $class, $propertyName);
            }

            $headerTitles[$propertyName] = $title;
        }

        return $this->renderer->renderTable($rows, $headerTitles);
    }

    /**
     * @param HeaderTransformerInterface $headerTransformer
     * @return Objectable
     */
    public function setHeaderTransformer(HeaderTransformerInterface $headerTransformer): Objectable
    {
        $this->headerTransformer = $headerTransformer;
        return $this;
    }

    /**
     * @param ReflectionClass $reflection
     * @return Header[]
     */
    protected function fetchHeadersFromObjectReflection(ReflectionClass $reflection): array
    {
        $output = [];
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            /** @var Header $annotation */
            $annotation = $this->annotationReader->getPropertyAnnotation($property, Header::class);

            if ($annotation !== null) {
                $output[$property->name] = $annotation;
            }
        }

        uasort($output, static function ($a, $b) {
            /** @var Header $a */
            /** @var Header $b */
            if ($a->order === null) {
                return -1;
            }

            if ($a->order === $b->order) {
                throw ObjectableException::sameHeadersOrder($a, $b);
            }

            if ($a->order > $b->order) {
                return 1;
            }

            return -1;
        });

        return $output;
    }


    /**
     * @param ReflectionClass $reflection
     * @return ActionField[]
     */
    protected function fetchActionFieldsFromObjectReflection(ReflectionClass $reflection): array
    {
        $actionFieldAnnotations = [];
        $allAnnotations = $this->annotationReader->getClassAnnotations($reflection);

        foreach ($allAnnotations as $annotation) {
            if ($annotation instanceof ActionField) {
                $actionFieldAnnotations[] = $annotation;
            }
        }

        return $actionFieldAnnotations;
    }

    /**
     * @param string $className
     * @param string $propertyName
     * @return string
     * @throws ObjectableException
     */
    protected function transformValue(mixed $value, string $className, string $propertyName): ?string
    {
        if (count($this->valueTransformers) === 0 && is_array($value)) {
            throw new ObjectableException('Could not transform array value as there are no transformers defined.');
        }

        if (count($this->valueTransformers) === 0 && $value === null) {
            return $this->configuration['null_format'];
        }

        if (count($this->valueTransformers) === 0 && $value instanceof DateTime) {
            return $value->format($this->configuration['datetime_format']);
        }

        if (count($this->valueTransformers) === 0 && $value === true) {
            return $this->configuration['true_format'];
        }

        if (count($this->valueTransformers) === 0 && $value === false) {
            return $this->configuration['false_format'];
        }

        //if there is no value transformers, just return the value
        if (count($this->valueTransformers) === 0) {
            return htmlentities((string) $value);
        }

        foreach ($this->valueTransformers as $transformer) {
            $stopPropagation = false;
            $value = $transformer->transform($value, $className, $propertyName, $stopPropagation);

            if ($stopPropagation) {
                return $value;
            }
        }

        return $value;
    }

    protected function extractRowMetadata($object): ItemMetadata
    {
        $class = $object::class;
        $reflectionClass = new ReflectionClass($class);

        //@TODO remove this
        $rowAnnotation = $this
            ->annotationReader
            ->getClassAnnotation(
                $reflectionClass,
                Row::class
            );

        //and this
        if ($rowAnnotation === null) {
            throw new ObjectableException('Class "' . $class . '" has no ' . Row::class . ' annotation defined.');
        }

        $rowMetadata = new ItemMetadata();
        $rowMetadata->setHeaders($this->fetchHeadersFromObjectReflection($reflectionClass));
        $rowMetadata->setActionFields($this->fetchActionFieldsFromObjectReflection($reflectionClass));

        return $rowMetadata;
    }
}