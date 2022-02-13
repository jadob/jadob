<?php


namespace Jadob\Objectable;


use Doctrine\Common\Annotations\Reader;
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

        if($this->propertyAccessor === null) {
           $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
        }

        if($this->metadataParser === null) {
            $this->metadataParser = new ItemMetadataParser();
        }
    }

    /**
     * Returns array of values from fields annotated with Header class and matching context.
     * @param object $item
     * @param string[] $context
     * @return array
     */
    public function extractItemValues(object $item, array $context = ['default']): array
    {
        $metadata = $this->metadataParser->parse(get_class($item));

    }
}