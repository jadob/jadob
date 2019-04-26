<?php

namespace Jadob\Router\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Router\Context;
use Jadob\Router\RouteCollection;
use Jadob\Router\Router;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Class RouterServiceProvider
 * @package Jadob\Router\ServiceProvider
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
     * @param $config
     * @return \Closure[]
     * @throws \Jadob\Router\Exception\RouterException
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function register($config)
    {
        return ['router' => function (Container $container) use ($config) {
            $collection = $config['routes'];
            if (\is_array($config['routes'])) {
                $collection = RouteCollection::fromArray($config['routes']);
            }

            $router = new Router($collection, Context::fromGlobals());
            $router->setGlobalParams([
                '_locale' => 'en'
            ]);

            return $router;
        }];

    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}
