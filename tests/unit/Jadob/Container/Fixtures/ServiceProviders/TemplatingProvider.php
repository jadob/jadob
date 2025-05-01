<?php

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class TemplatingProvider implements ServiceProviderInterface
{

    public function getConfigNode(): ?string
    {
        // TODO: Implement getConfigNode() method.
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        // TODO: Implement register() method.
    }
}