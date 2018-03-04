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
     * returns Config node name that will be passed as $config in register() method.
     * return null if no config needed.
     * @return string|null.
     */
    public function getConfigNode();

    /**
     * @param Container $container
     * @param array|null $config
     */
    public function register(Container $container, $config);
}