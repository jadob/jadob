<?php

declare(strict_types=1);

namespace Jadob\EventSourcing\EventStore\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\EventSourcing\EventStore\DBALEventStore;
use Jadob\EventSourcing\EventStore\EventDispatcher;
use Jadob\EventSourcing\EventStore\EventStoreInterface;
use Jadob\EventSourcing\EventStore\ProjectionManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class EventStoreProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigNode()
    {
        return 'event_store';
    }

    /**
     * {@inheritDoc}
     */
    public function register($config)
    {
        return [
            ProjectionManager::class => function (ContainerInterface $container) use ($config) {
                return new ProjectionManager($container->get(LoggerInterface::class));
            },
            EventDispatcher::class => function (ContainerInterface $container) use ($config) {
                return new EventDispatcher();
            },
            EventStoreInterface::class => function (ContainerInterface $container) use ($config) {
                $separateLogger = true;
                $connectionName = 'default';

                if (isset($config['separate_logger'])) {
                    $separateLogger = (bool)$config['separate_logger'];
                }

                if (isset($config['connection_name'])) {
                    $connectionName = $config['connection_name'];
                }

                $connection = $container->get('doctrine.dbal.' . $connectionName);

                if ($separateLogger) {
                    $logDir = $container->get(BootstrapInterface::class)->getLogsDir() . '/event_store.log';
                    $stream = new StreamHandler($logDir);
                    $logger = new Logger('event_store', [$stream]);
                } else {
                    $logger = $container->get(LoggerInterface::class);
                }

                return new DBALEventStore(
                    $connection,
                    $logger,
                    $container->get(ProjectionManager::class),
                    $container->get(EventDispatcher::class)
                );
            }
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}