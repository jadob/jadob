<?php

declare(strict_types=1);

namespace Jadob\Framework\Module;

use Jadob\Framework\ServiceProvider\AuthenticationProvider;
use Jadob\Security\Auth\EventListener\AuthenticationListener;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class AuthenticationModule implements ModuleInterface
{

    public function getServiceProviders(string $env): array
    {
        return [
            new AuthenticationProvider()
        ];
    }

    public function getContainerExtensionProviders(ContainerInterface $container, string $env): array
    {
        return [];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getEventListeners(ContainerInterface $container, string $env): array
    {
        return [
            $container->get(AuthenticationListener::class)
        ];
    }
}