<?php

namespace Jadob\Container\ServiceProvider;

use Jadob\Container\Container;

/**
 * Class AbstractServiceProvider
 *
 * @package Jadob\Container\ServiceProvider
 * @author  pizzaminded <miki@appvende.net>
 * @license MIT
 */
abstract class AbstractServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function register($config)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {

    }
}