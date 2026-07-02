<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Psr\Container\ContainerInterface;

interface ContainerExtensionProviderInterface
{
    /**
     * @return list<ConstructorInjectionExtensionInterface>
     */
    public function getConstructorInjectionExtensions(
        ContainerInterface $container
    ): array;

    /**
     * @return list<ContainerExtensionInterface>
     */
    public function getContainerExtensions(): array;
}
