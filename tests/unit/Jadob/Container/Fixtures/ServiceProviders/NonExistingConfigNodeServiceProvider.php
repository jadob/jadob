<?php

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class NonExistingConfigNodeServiceProvider implements ServiceProviderInterface
{

    public function getConfigNode(): ?string
    {
        return 'yeti';
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [];
    }
}