<?php

namespace Jadob\DoctrineDBALBridge\ServiceProvider;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Class DoctrineDBALServiceProvider
 * @package Jadob\DoctrineDBALBridge\ServiceProvider
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
        return 'doctrine_dbal';
    }

    /**
     * @param ContainerBuilder $container
     * @param $config
     * @throws \Doctrine\DBAL\DBALException
     */
    public function register(ContainerBuilder $container, $config)
    {
        $configObject = new Configuration();
        $container->add('doctrine.dbal', DriverManager::getConnection($config, $configObject));
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
    }
}