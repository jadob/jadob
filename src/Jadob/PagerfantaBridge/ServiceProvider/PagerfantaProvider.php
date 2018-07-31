<?php

namespace Jadob\PagerfantaBridge\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\PagerfantaBridge\Twig\Extension\PagerfantaExtension;

/**
 * Class PagerfantaProvider
 * @package Jadob\PagerfantaBridge\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class PagerfantaProvider implements ServiceProviderInterface
{

    /**
     * returns Config node name that will be passed as $config in register() method.
     * return null if no config needed.
     * @return string|null.
     */
    public function getConfigNode()
    {
        return null;
    }

    /**
     * @param Container $container
     * @param array|null $config
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function register(Container $container, $config)
    {
        $container->get('twig')->addExtension(
            new PagerfantaExtension(
                $container->get('request'),
                $container->get('router')
            )
        );
    }
}