<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Psr\Container\ContainerInterface;

interface ContainerExtensionProviderInterface
{
    /**
     * @param ContainerInterface $container
     * @return list<ContainerAutowiringExtensionInterface>
     */
    public function getAutowiringExtensions(
        ContainerInterface $container
    ): array;
}