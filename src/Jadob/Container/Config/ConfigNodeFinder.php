<?php

namespace Jadob\Container\Config;

class ConfigNodeFinder implements ConfigNodeFinderInterface
{
    /**
     * @param array<non-empty-string> $paths sorted ascending by priority
     */
    public function __construct(
        private array $paths = []
    )
    {
    }

    public function find(string $node): array {
        return [];
    }



}