<?php
declare(strict_types=1);

namespace Jadob\Objectable;

/**
 * @license MIT
 */
class ItemMetadataParser
{

    /**
     * @psalm-var array<class-string,ItemMetadata>
     */
    protected array $parsed = [];


    /**
     * @psalm-param class-string $object
     * @param string $object
     * @return ItemMetadata
     */
    public function parse(string $object): ItemMetadata
    {
        
    }

}