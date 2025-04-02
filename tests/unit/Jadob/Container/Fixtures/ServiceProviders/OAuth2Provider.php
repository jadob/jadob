<?php

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class OAuth2Provider implements ServiceProviderInterface, ParentServiceProviderInterface
{

    public function getParentServiceProviders(): array
    {
        return [
            HttpClientProvider::class
        ];
    }

    public function getConfigNode(): ?string
    {
        // TODO: Implement getConfigurationNode() method.
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        // TODO: Implement register() method.
    }
}