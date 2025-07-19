<?php

declare(strict_types=1);

namespace Jadob\Authora\Module;

use Jadob\Authora\EventListener\AuthenticationEventListener;
use Jadob\Authora\ServiceProvider\AuthoraServiceProvider;
use Jadob\Contracts\Framework\Module\ModuleInterface;
use Psr\Container\ContainerInterface;

class AuthoraModule implements ModuleInterface
{

    public function getServiceProviders(string $env): array
    {
        return [
            new AuthoraServiceProvider(),
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