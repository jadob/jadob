<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\DBAL\ServiceProvider;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\Console\Command\ReservedWordsCommand;
use Doctrine\DBAL\Tools\Console\Command\RunSqlCommand;
use Doctrine\DBAL\Tools\Console\ConnectionProvider\SingleConnectionProvider;
use Doctrine\DBAL\Types\Type;
use Doctrine\Persistence\ManagerRegistry;
use InvalidArgumentException;
use Jadob\Bridge\Doctrine\DBAL\Logger\Psr11QueryLogger;
use Jadob\Bridge\Doctrine\Persistence\DoctrineManagerRegistry;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use LogicException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use RuntimeException;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Class DoctrineDBALProvider
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DoctrineDBALProvider implements ServiceProviderInterface
{
    private const CONNECTION_SERVICE_NAME_FORMAT = 'doctrine.dbal.%s';

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return 'doctrine_dbal';
    }

    /**
     * {@inheritdoc}
     *
     * @return (EventManager|\Closure|\Closure|\Closure|\Closure)[]
     *
     * @psalm-return array<string, EventManager|\Closure(ContainerInterface):Configuration|\Closure(ContainerInterface):Logger|\Closure(ContainerInterface):Psr3QueryLogger|\Closure(ContainerInterface):\Doctrine\DBAL\Connection>
     * @throws RuntimeException
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function register($config)
    {
        if (!isset($config['connections']) || \count($config['connections']) === 0) {
            throw new RuntimeException('You should provide at least one connection in "doctrine_dbal" config node.');
        }


        if (isset($config['types'])) {
            foreach ($config['types'] as $name => $class) {
                if(!is_string($class) || !is_string($name)) {
                    throw new LogicException(
                        'Cannot register DBAL types as its name or value is not a string'
                    );
                }

                /** @var class-string<Type> $class */
                Type::addType($name, $class);
            }
        }

        $services = [];
        $services[EventManager::class] = $eventManager = new EventManager();


        $services['doctrine.dbal.logger'] = function (ContainerInterface $container): Logger {
            $logger = new Logger('doctrine_dbal');
            $handler = new StreamHandler($container->get(BootstrapInterface::class)->getLogsDir() . '/dbal.log');
            $logger->pushHandler($handler);

            return $logger;
        };

        $services['doctrine.dbal.query.logger'] = function (ContainerInterface $container): Psr11QueryLogger {
            $logger = new Psr11QueryLogger(
                $container->get('doctrine.dbal.logger')
            );

            return $logger;
        };


        $services[Configuration::class] = function (ContainerInterface $container): Configuration {
            $configuration = new Configuration();
            $configuration->setSQLLogger($container->get('doctrine.dbal.query.logger'));

            return $configuration;
        };

        $defaultConnectionName = null;
        foreach ($config['connections'] as $connectionName => $configuration) {
            $serviceName = sprintf(self::CONNECTION_SERVICE_NAME_FORMAT, $connectionName);
            if (isset($configuration['default']) && (bool) $configuration['default']) {
                if ($defaultConnectionName !== null) {
                    throw new InvalidArgumentException('There are at least two default DBAL connections defined! Check your configuration file.');
                }

                $defaultConnectionName = $connectionName;
            }

            $services[$serviceName] = function (ContainerInterface $container) use ($configuration, $eventManager): \Doctrine\DBAL\Connection {
                return DriverManager::getConnection(
                    $configuration,
                    $container->get(Configuration::class),
                    $eventManager
                );
            };
        }

        if ($defaultConnectionName === null) {
            throw new InvalidArgumentException('There is no default DBAL connections defined! Check your configuration file.');
        }

        return $services;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function onContainerBuild(Container $container, $config)
    {
        if ($container->has('console')) {
            /**
             * @var Application $console
             */
            $console = $container->get('console');

            $connectionProvider = new SingleConnectionProvider(
                $container->get('doctrine.dbal.default')
            );

            $console->addCommands(
                [
                    new ReservedWordsCommand($connectionProvider),
                    new RunSqlCommand($connectionProvider)
                ]
            );
        }

        if ($container->has(ManagerRegistry::class)) {

            /** @var DoctrineManagerRegistry $managerRegistry */
            $managerRegistry = $container->get(ManagerRegistry::class);
            foreach ($config['connections'] as $connectionName => $configuration) {
                $serviceName = sprintf(self::CONNECTION_SERVICE_NAME_FORMAT, $connectionName);

                $managerRegistry->addConnection(
                    $connectionName,
                    $container->get($serviceName)
                );

                if ($configuration['default']) {
                    $managerRegistry->setDefaultConnectionName($connectionName);
                }
            }
        }
    }
}