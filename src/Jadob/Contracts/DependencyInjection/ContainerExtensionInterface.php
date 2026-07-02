<?php
declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

interface ContainerExtensionInterface
{
    public function onContainerBuild(
        ExtendedContainerInterface $container,
    ): void;
}
