<?php

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

/**
 * Requires two random things outside of its original hierarchy.
 */
class IOLoggerProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{

    public function getParentServiceProviders(): array
    {
        return [
            HttpClientProvider::class,
            DatabaseServiceProvider::class,
        ];
    }

    public function getConfigNode(): ?string
    {
        return null;
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [];
    }
}