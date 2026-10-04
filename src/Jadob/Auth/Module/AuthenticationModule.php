<?php
declare(strict_types=1);

namespace Jadob\Auth\Module;

use Jadob\Auth\ServiceProvider\AuthenticationServiceProvider;
use Jadob\Contracts\Framework\Module\ModuleInterface;
use Jadob\Router\RouteCollection;

final readonly class AuthenticationModule implements ModuleInterface
{
    public function getServiceProviders(string $env): array
    {
        return [
            new AuthenticationServiceProvider(),
        ];
    }

    public function getContainerCompilerExtensions(): array
    {
        return [];
    }

    public function getRoutes(): ?RouteCollection
    {
        return null;
    }
}