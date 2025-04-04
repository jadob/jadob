<?php

namespace Jadob\Framework\DependencyInjection\ExtensionProvider;

use Jadob\Contracts\DependencyInjection\ContainerExtensionProviderInterface;
use Jadob\Framework\DependencyInjection\Extension\InjectLoggerAutowireExtension;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class FrameworkContainerExtensionProvider implements ContainerExtensionProviderInterface
{

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAutowiringExtensions(ContainerInterface $container): array
    {
        return [
            $container->get(InjectLoggerAutowireExtension::class)
        ];
    }

    public function getContainerExtensions(): array
    {
        return [];
    }
}