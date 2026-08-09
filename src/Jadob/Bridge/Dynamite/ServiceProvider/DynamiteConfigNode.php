<?php

namespace Jadob\Bridge\Dynamite\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;

final class DynamiteConfigNode implements ConfigNodeInterface
{
    private(set) bool $mappingCacheEnabled = false;

    public function enableMappingCache(): self
    {
        $this->mappingCacheEnabled = true;

        return $this;
    }

}