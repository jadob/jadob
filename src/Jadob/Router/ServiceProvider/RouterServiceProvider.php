<?php

namespace Jadob\Router\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
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
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function register($config)
    {
        return ['router' => function (Container $container) use ($config) {
            $router = new Router($config['routes'], $container->get('request'));
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
