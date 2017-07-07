<?php

namespace Slice\Router\ServiceProvider;

use Slice\Config\Configuration;
use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\Router\RouteCollection;
use Slice\Router\Router;

/**
 * Class RouterServiceProvider
 * @package Slice\Router\ServiceProvider
 */
class RouterServiceProvider implements ServiceProviderInterface
{

    /**
     * @param Container $container
     * @param Configuration $configuration
     */
    public function register(Container $container, Configuration $configuration)
    {

        $routeCollection = new RouteCollection($configuration->getSection('routes'));
        $router = new Router();
        $router->setRouteCollection($routeCollection);

        $container->add('router', $router);

    }

}