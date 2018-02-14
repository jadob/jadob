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
     * @return mixed
     */
    public function getConfigNode();

    /**
     * @param Container $container
     * @param $config
     */
    public function register(Container $container, $config);
}