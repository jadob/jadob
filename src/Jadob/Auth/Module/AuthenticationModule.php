<?php
declare(strict_types=1);

namespace Jadob\Auth\Module;

use Jadob\Auth\ServiceProvider\AuthenticationServiceProvider;
use Jadob\Contracts\Framework\Module\ModuleInterface;

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