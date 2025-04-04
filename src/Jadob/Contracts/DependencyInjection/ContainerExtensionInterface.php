<?php
declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Jadob\Container\Container;

interface ContainerExtensionInterface
{
    public function onContainerBuild(
        Container $container,
    ): void;
}