<?php

declare(strict_types=1);

namespace Jadob\EventStore\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\EventStore\DBALEventStore;
use Jadob\EventStore\EventDispatcher;
use Jadob\EventStore\EventStoreInterface;
use Jadob\EventStore\ProjectionManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use RuntimeException;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class EventStoreProvider implements ServiceProviderInterface
{

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function getConfigNode()
    {
        return 'event_store';
    }

    /**
     * {@inheritDoc}
     *
     * @return (\Closure|\Closure|\Closure)[]
     *
     * @psalm-return array{Jadob\EventSourcing\EventStore\ProjectionManager: \Closure(ContainerInterface):ProjectionManager, Jadob\EventSourcing\EventStore\EventDispatcher: \Closure(ContainerInterface):EventDispatcher, Jadob\EventSourcing\EventStore\EventStoreInterface: \Closure(ContainerInterface):DBALEventStore}
     */
    #[\Override]
    public function register($config)
    {
        if (!isset($config['connection_name'])) {
            throw new RuntimeException('Missing connection_name option in event_store configuration. ');
        }

        return [
            ProjectionManager::class => function (ContainerInterface $container) use ($config) {
                $projectionManager = new ProjectionManager($container->get(LoggerInterface::class));
                foreach ($config['projections'] as $projectionService) {
                    $projectionManager->addProjection($container->get($projectionService));
                }

                return $projectionManager;
            },
            EventDispatcher::class => fn(ContainerInterface $container) => new EventDispatcher(),
            EventStoreInterface::class => function (ContainerInterface $container) use ($config) {
                $separateLogger = true;
                if (isset($config['separate_logger'])) {
                    $separateLogger = (bool) $config['separate_logger'];
                }

                $connectionName = $config['connection_name'];
                $connection = $container->get('doctrine.dbal.' . $connectionName);

                if ($separateLogger) {
                    $logDir = $container->get(BootstrapInterface::class)->getLogsDir();
                    $logPath = $logDir. '/event_store.log';
                    $stream = new StreamHandler($logPath);
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
    #[\Override]
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}