<?php

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class HttpClientProvider implements ServiceProviderInterface
{


    public function getConfigNode(): ?string
    {
        // TODO: Implement getConfigurationNode() method.
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        // TODO: Implement register() method.
    }
}