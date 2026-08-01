<?php
declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

/**
 * @deprecated
 */
interface ContainerExtensionInterface
{
    public function onContainerBuild(
        ContainerInterface $container,
    ): void;
}
