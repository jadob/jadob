<?php

declare(strict_types=1);

namespace Jadob\Framework\Module;

use Jadob\Framework\DependencyInjection\ExtensionProvider\FrameworkContainerExtensionProvider;
use Jadob\Framework\ServiceProvider\ConsoleProvider;
use Jadob\Framework\ServiceProvider\EventDispatcherProvider;
use Jadob\Framework\ServiceProvider\FrameworkServiceProvider;
use Jadob\Framework\ServiceProvider\LoggerServiceProvider;
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
            new FrameworkServiceProvider(),
            new LoggerServiceProvider(),
        ];
    }

    public function getContainerExtensionProviders(string $env): array
    {
        return [
            new FrameworkContainerExtensionProvider()
        ];
    }

    public function getEventListeners(ContainerInterface $container, string $env): array
    {
        return [];
    }
}