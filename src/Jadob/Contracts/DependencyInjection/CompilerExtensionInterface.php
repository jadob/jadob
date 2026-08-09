<?php

namespace Jadob\Contracts\DependencyInjection;

use Jadob\Container\ServiceGraph;

interface CompilerExtensionInterface
{
    public function onContainerBuild(
        ServiceGraph $serviceGraph,
    ): void;
}