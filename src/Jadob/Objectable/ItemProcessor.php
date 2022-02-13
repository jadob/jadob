<?php


namespace Jadob\Objectable;


use Doctrine\Common\Annotations\Reader;
use Jadob\Objectable\Annotation\Field;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class ItemProcessor
{

    public function __construct(
        protected Reader $annotReader,
        protected ?PropertyAccessor $propertyAccessor = null,
        protected ?ItemMetadataParser $metadataParser = null
    )
    {

        if ($this->propertyAccessor === null) {
            $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
        }

        if ($this->metadataParser === null) {
            $this->metadataParser = new ItemMetadataParser();
        }
    }

    /**
     * Returns array of values from fields annotated with Field class and matching context.
     * @param object $item
     * @param string[] $context
     * @return array
     */
    public function extractItemValues(object $item, array $context = ['default']): array
    {
        $output = [];
        $ref = new \ReflectionClass($item);
        $props = $ref->getProperties();

        foreach ($props as $reflectionProperty) {
            $attrs = $reflectionProperty->getAttributes(Field::class);
            $shouldExtract = false;
            foreach ($attrs as $fieldAttr) {
                /** @var Field $instance */
                $instance = $fieldAttr->newInstance();

                #TODO: there should be some array intersection or something similar
                foreach ($context as $singleContext) {
                    if ($instance->hasContext($singleContext)) {
                        $val = $reflectionProperty->getValue($item);

                        $output[$instance->getName()] = $val;

                        if ($instance->isStringable()) {
                            $output[$instance->getName()] = (string)$val;
                        }
                    }
                }
            }


        }

        return $output;
    }
}