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
            600 => new AuthenticationServiceProvider(),
        ];
    }

    public function getContainerCompilerExtensions(): array
    {
        return [];
    }
}