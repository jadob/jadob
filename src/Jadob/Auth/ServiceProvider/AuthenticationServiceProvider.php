<?php
declare(strict_types=1);

namespace Jadob\Auth\ServiceProvider;

use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

final readonly class AuthenticationServiceProvider implements ServiceProviderInterface, ConfigObjectProviderInterface
{
    public function getDefaultConfigurationObject(): object
    {
        return new AuthenticationConfig();
    }

    public function getConfigNode(): ?string
    {
        return 'authentication';
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        // TODO: Implement register() method.
    }
}