<?php
declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Jadob\Container\ServiceGraph;

interface CompilerExtensionInterface
{
    public function onContainerBuild(
        ServiceGraph $serviceGraph,
    ): void;
}