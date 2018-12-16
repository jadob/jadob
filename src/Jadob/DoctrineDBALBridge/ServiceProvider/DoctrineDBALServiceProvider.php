<?php

namespace Jadob\DoctrineDBALBridge\ServiceProvider;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Logging\DebugStack;
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
     * @throws \RuntimeException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function register(ContainerBuilder $container, $config)
    {

        if (!isset($config['connections']) || \count($config['connections']) === 0) {
            throw new \RuntimeException('You should provide at least one connection in config.doctrine_dbal node.');
        }

        $configObject = new Configuration();
        $eventManager = new EventManager();
        $debugStackLogger = new DebugStack();
        $configObject->setSQLLogger($debugStackLogger);

        $container->add('doctrine.dbal.config', $configObject);
        $container->add('doctrine.dbal.event_manager', $eventManager);
        $container->add('doctrine.dbal.debug_stack.logger', $debugStackLogger);

        foreach ($config['connections'] as $connectionName => $configuration) {
            $container->add(
                'doctrine.dbal.' . $connectionName,
                DriverManager::getConnection($configuration, $configObject, $eventManager)
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
    }
}