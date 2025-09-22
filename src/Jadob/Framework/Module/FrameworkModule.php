<?php

declare(strict_types=1);

namespace Jadob\Framework\Module;

use Jadob\Contracts\Framework\Module\ModuleInterface;
use Jadob\Framework\DependencyInjection\ExtensionProvider\ConsoleExtensionProvider;
use Jadob\Framework\DependencyInjection\ExtensionProvider\EventDispatcherExtensionProvider;
use Jadob\Framework\DependencyInjection\ExtensionProvider\FrameworkContainerExtensionProvider;
use Jadob\Framework\ServiceProvider\ConsoleProvider;
use Jadob\Framework\ServiceProvider\ErrorHandlerServiceProvider;
use Jadob\Framework\ServiceProvider\EventDispatcherProvider;
use Jadob\Framework\ServiceProvider\FrameworkServiceProvider;
use Jadob\Framework\ServiceProvider\LoggerServiceProvider;
use Jadob\Framework\ServiceProvider\SessionProvider;
use Jadob\Router\ServiceProvider\RouterServiceProvider;
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
            new ErrorHandlerServiceProvider($env)
        ];
    }

    public function getContainerExtensionProviders(string $env): array
    {
        return [
            new FrameworkContainerExtensionProvider(),
            new ConsoleExtensionProvider(),
            new EventDispatcherExtensionProvider(),
        ];
    }

    public function getEventListeners(ContainerInterface $container, string $env): array
    {
        return [];
    }
}