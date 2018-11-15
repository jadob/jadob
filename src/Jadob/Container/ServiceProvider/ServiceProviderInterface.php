<?php

namespace Jadob\Container\ServiceProvider;

use Jadob\Container\Container;

/**
 * Interface ServiceProviderInterface
 * @package Jadob\Container\ServiceProvider
 */
interface ServiceProviderInterface
{

    /**
     * Returns config node name that will be passed as $config in register() method or null if no config needed.
     * @return string|null
     */
    public function getConfigNode();

    /**
     * @TODO: maybe we should typehint ContainerInterface instead of Container? this will allow to be more flexible
     * @param Container $container
     * @param array|null $config
     */
    public function register(Container $container, $config);
}