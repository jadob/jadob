<?php

declare(strict_types=1);

namespace Jadob\Container;

use Psr\Container\ContainerInterface;

class ServiceGraphContainer implements  ContainerInterface
{
    public function __construct(
        private ServiceGraph $graph
    )
    {
    }

    public function get(string $id): object
    {
    }

    public function has(string $id): bool
    {
    }
}