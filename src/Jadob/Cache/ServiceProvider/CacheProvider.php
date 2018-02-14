<?php

namespace Jadob\Cache\ServiceProvider;

use Jadob\Cache\FileCache;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Class CacheProvider
 * @package Jadob\Cache\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class CacheProvider implements ServiceProviderInterface
{

    /**
     * @return mixed
     */
    public function getConfigNode()
    {
        return null;
    }

    /**
     * @param Container $container
     * @param $config
     */
    public function register(Container $container, $config)
    {
        /** @var \Bootstrap $bootstrap */
        $bootstrap = $container->get('bootstrap');

        $container->add('cache', new FileCache($bootstrap->getCacheDir()));
    }
}