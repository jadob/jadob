<?php

namespace Jadob\Auth\Module;

use Jadob\Auth\EventListener\AuthenticationEventListener;
use Jadob\Auth\ServiceProvider\AuthenticationServiceProvider;
use Jadob\Contracts\Framework\Module\ModuleInterface;
use Psr\Container\ContainerInterface;

final readonly class AuthenticationModule implements ModuleInterface
{

    public function getServiceProviders(string $env): array
    {
        return [
            new AuthenticationServiceProvider(),
        ];
    }

    public function getContainerExtensionProviders(string $env): array
    {
        return [];
    }

    public function getEventListeners(ContainerInterface $container, string $env): array
    {
        return [
           $container->get(AuthenticationEventListener::class),
        ];
    }
}