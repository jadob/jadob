<?php

namespace Jadob\Framework\DependencyInjection\ExtensionProvider;

use Jadob\Contracts\DependencyInjection\ContainerExtensionInterface;
use Jadob\Contracts\DependencyInjection\ContainerExtensionProviderInterface;
use Jadob\Framework\DependencyInjection\Extension\ConsoleCommandExtension;
use Psr\Container\ContainerInterface;

class ConsoleExtensionProvider implements ContainerExtensionProviderInterface
{
    public function getAutowiringExtensions(
        ContainerInterface $container
    ): array {
        return [];
    }

    /**
     * @return list<ContainerExtensionInterface>
     */
    public function getContainerExtensions(): array {
        return [
            new ConsoleCommandExtension()
        ];
    }
}