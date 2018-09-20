<?php

namespace Jadob\Router\ServiceProvider;

use Jadob\Container\Container;
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
     * @throws \RuntimeException
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function register(Container $container, $config)
    {
        $router = new Router($config, $container->get('request'));

        $router->setGlobalParams([
            '_locale' => $container->get('globals')->get('locale')
        ]);

        $container->add('router', $router);

    }

}
