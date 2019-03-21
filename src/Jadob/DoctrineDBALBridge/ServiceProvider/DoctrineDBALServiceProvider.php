<?php

namespace Jadob\DoctrineDBALBridge\ServiceProvider;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Logging\DebugStack;
use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\DoctrineDBALBridge\Logger\Psr3QueryLogger;
use Psr\Container\ContainerInterface;

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
     * @throws \RuntimeException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function register($config)
    {

        if (!isset($config['connections']) || \count($config['connections']) === 0) {
            throw new \RuntimeException('You should provide at least one connection in config.doctrine_dbal node.');
        }

        $services['doctrine.dbal.event_manager'] = $eventManager = new EventManager();

        $services['doctrine.dbal.config'] = function (ContainerInterface $container) {
            $configObject = new Configuration();
            $configObject->setSQLLogger(new Psr3QueryLogger($container->get('monolog')));
            return $configObject;
        };

        foreach ($config['connections'] as $connectionName => $configuration) {
            $services['doctrine.dbal.' . $connectionName] = function (ContainerInterface $container) use ($configuration, $eventManager) {
                return DriverManager::getConnection(
                    $configuration,
                    $container->get('doctrine.dbal.config'),
                    $eventManager
                );
            };

        }

        return $services;
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
    }
}