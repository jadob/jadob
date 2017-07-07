<?php

namespace Slice\Container\ServiceProvider;

use Slice\Config\Configuration;
use Slice\Container\Container;

/**
 * Interface ServiceProviderInterface
 * @package Slice\Container\ServiceProvider
 */
interface ServiceProviderInterface {

    /**
     * @param Container $container
     * @param Configuration $configuration
     */
    public function register(Container $container, Configuration $configuration);
}