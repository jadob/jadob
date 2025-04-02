<?php

namespace Jadob\Contracts\DependencyInjection;

use Closure;
use Psr\Container\ContainerInterface;

interface ServiceProviderInterface
{

    /**
     * If your services require some configuration, you can create a config node, return its name here and it will
     * be passed further into register() method.
     * @return string|null
     */
    public function getConfigNode(): ?string;


    /**
     * Configure and register your services here.
     *
     * @param ContainerInterface $container
     * @param array|object|null $config
     * @return array<string|class-string, array|Closure|object>
     */
    public function register(
        ContainerInterface $container,
        array|object|null $config = null
    ): array;

}