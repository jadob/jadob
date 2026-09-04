<?php
declare(strict_types=1);

namespace Jadob\Container\Config;

interface ConfigNodeFinderInterface
{
    /**
     * Returns an array because there may be multiple nodes (e.g. base config, production, enterprise customer config).
     * Nodes should be returned in ascending-priority order.
     * @param string $node
     * @return array<ConfigNodeInterface>
     */
    public function find(string $node): array;
}