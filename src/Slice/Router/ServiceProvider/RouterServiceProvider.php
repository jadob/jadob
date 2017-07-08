<?php

namespace Slice\Router\ServiceProvider;

use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\Core\HTTP\Request;
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
     * @param array $configuration
     * @throws \Slice\Container\Exception\ContainerException
     */
    public function register(Container $container, array $configuration)
    {
        /** @var Request $request */
        $request = $container->get('request');

        $router = new Router($configuration['router']);
        $router
            ->setRouteCollection(new RouteCollection($configuration['routes']))
            ->setRequest($request);

        $container->add('router', $router);
    }
}