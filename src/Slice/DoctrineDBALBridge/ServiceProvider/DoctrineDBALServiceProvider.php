<?php

namespace Slice\DoctrineDBALBridge\ServiceProvider;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Class DoctrineDBALServiceProvider
 * @package Slice\DoctrineDBALBridge\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DoctrineDBALServiceProvider implements ServiceProviderInterface
{

    /**
     * @return string
     */
    public function getConfigNode()
    {
        return 'dbal';
    }

    /**
     * @param Container $container
     * @param $config
     * @throws \Doctrine\DBAL\DBALException
     */
    public function register(Container $container, $config)
    {

        $configObject = new Configuration();
        $container->add('doctrine.dbal', DriverManager::getConnection($config, $configObject));

    }

}