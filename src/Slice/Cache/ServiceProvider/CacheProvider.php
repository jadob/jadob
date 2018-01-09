<?php
/**
 * Created by PhpStorm.
 * User: mikolajczajkowsky
 * Date: 09.01.2018
 * Time: 17:28
 */

namespace Slice\Cache\ServiceProvider;


use Slice\Cache\FileCache;
use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;

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