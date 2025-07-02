<?php

namespace Jadob\Framework\DependencyInjection\ExtensionProvider;

use Jadob\Contracts\DependencyInjection\ContainerExtensionProviderInterface;
use Jadob\Framework\DependencyInjection\Extension\EventDispatcherExtension;
use Psr\Container\ContainerInterface;

class EventDispatcherExtensionProvider implements ContainerExtensionProviderInterface
{

    public function getAutowiringExtensions(
        ContainerInterface $container
    ): array
    {
        return [];
    }

    public function getContainerExtensions(): array
    {
        return [
            new EventDispatcherExtension()
        ];
    }
}