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
     * @param Container $container
     * @param $config
     * @return mixed|void
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function register(ContainerBuilder $container, $config)
    {

        $container->add('router', function (Container $container) use ($config) {
            $router = new Router($config['routes'], $container->get('request'));
            $router->setGlobalParams([
                '_locale' => 'en'
            ]);

            return $router;
        });

    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}
