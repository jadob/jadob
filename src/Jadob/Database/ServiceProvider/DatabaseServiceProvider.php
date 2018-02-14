<?php

namespace Jadob\Database\ServiceProvider;


use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Database\Database;

/**
 * Class DatabaseServiceProvider
 * @package Jadob\Database\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DatabaseServiceProvider implements ServiceProviderInterface
{

    /**
     * @return string
     */
    public function getConfigNode()
    {
        return 'database';
    }

    /**
     * @param Container $container
     * @param $config
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function register(Container $container, $config)
    {
        $container->add('database', new Database($container->get('doctrine.dbal'), $config));
    }

}