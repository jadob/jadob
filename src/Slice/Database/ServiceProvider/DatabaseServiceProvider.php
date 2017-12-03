<?php

namespace Slice\Database\ServiceProvider;


use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\Database\Database;

/**
 * Class DatabaseServiceProvider
 * @package Slice\Database\ServiceProvider
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
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Slice\Container\Exception\ContainerException
     */
    public function register(Container $container, $config)
    {
        $container->add('database', new Database($container->get('doctrine.dbal'), $config));
    }

}