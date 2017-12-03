<?php

namespace Slice\Router\ServiceProvider;

use Slice\Container\Container;
use Slice\Router\Router;
use Slice\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Class RouterServiceProvider
 * @package Slice\Router\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class RouterServiceProvider implements ServiceProviderInterface
{

    /**
     * @return string
     */
    public function getConfigNode()
    {
        return 'router';
    }

    /**
     * @param Container $container
     * @param $config
     * @return mixed|void
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Slice\Container\Exception\ContainerException
     */
    public function register(Container $container, $config)
    {
        $container->add('router', new Router($config, $container->get('request')));

    }

}
