<?php

declare(strict_types=1);

namespace Jadob\Framework\Module;

use Jadob\Contracts\Framework\Module\ModuleInterface;
use Jadob\Framework\DependencyInjection\CompilerExtension\InjectLoggerExtension;
use Jadob\Framework\DependencyInjection\CompilerExtension\RegisterConsoleCommandsExtension;
use Jadob\Framework\DependencyInjection\CompilerExtension\RegisterEventListenersExtension;
use Jadob\Framework\DependencyInjection\ExtensionProvider\EventDispatcherExtensionProvider;
use Jadob\Framework\DependencyInjection\ExtensionProvider\FrameworkContainerExtensionProvider;
use Jadob\Framework\ServiceProvider\ConsoleProvider;
use Jadob\Framework\ServiceProvider\ErrorHandlerServiceProvider;
use Jadob\Framework\ServiceProvider\EventDispatcherProvider;
use Jadob\Framework\ServiceProvider\LoggerServiceProvider;
use Jadob\Framework\ServiceProvider\SessionProvider;
use Jadob\Router\ServiceProvider\RouterServiceProvider;

final readonly class FrameworkModule implements ModuleInterface
{
    public function getServiceProviders(string $env): array
    {
        return [
            new EventDispatcherProvider(),
            new RouterServiceProvider(),
            new ConsoleProvider(),
            new SessionProvider(),
            // new FrameworkServiceProvider(),  // @TODO: check if this one is really required
            new LoggerServiceProvider(),
            new ErrorHandlerServiceProvider($env)
        ];
    }

    public function getContainerCompilerExtensions(): array
    {
        return [
            500 => new RegisterEventListenersExtension(),
            510 => new RegisterConsoleCommandsExtension(),
            520 => new InjectLoggerExtension(),
        ];
    }

}