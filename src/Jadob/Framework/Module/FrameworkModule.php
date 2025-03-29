<?php

declare(strict_types=1);

namespace Jadob\Framework\Module;

use Jadob\Framework\DependencyInjection\Extension\InjectLoggerAutowireExtension;
use Jadob\Framework\ServiceProvider\ConsoleProvider;
use Jadob\Framework\ServiceProvider\EventDispatcherProvider;
use Jadob\Framework\ServiceProvider\RouterServiceProvider;
use Jadob\Framework\ServiceProvider\SessionProvider;
use Psr\Container\ContainerInterface;

class FrameworkModule implements ModuleInterface
{

    public function getServiceProviders(string $env): array
    {
        return [
            new EventDispatcherProvider(),
            new RouterServiceProvider(),
            new ConsoleProvider(),
            new SessionProvider(),
        ];
    }

    public function getContainerExtensionProviders(ContainerInterface $container, string $env): array
    {
        return [
            $container->get(InjectLoggerAutowireExtension::class)
        ];
    }

    public function getEventListeners(ContainerInterface $container, string $env): array
    {
        return [];
    }
}