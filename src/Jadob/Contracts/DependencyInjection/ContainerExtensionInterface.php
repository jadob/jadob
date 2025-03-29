<?php

namespace Jadob\Contracts\DependencyInjection;

use Psr\Container\ContainerInterface;

interface ContainerExtensionInterface
{
    public function onContainerBuild(
        ContainerInterface $container,
    ): void;
}