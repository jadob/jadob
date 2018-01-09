<?php

namespace Slice\Container\ServiceProvider;

use Slice\Container\Container;

/**
 * Interface ServiceProviderInterface
 * @package Slice\Container\ServiceProvider
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