<?php

namespace Jadob\Bridge\Doctrine\DBAL\ServiceProvider;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\Console\Command\ReservedWordsCommand;
use Doctrine\DBAL\Tools\Console\Command\RunSqlCommand;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Jadob\Bridge\Doctrine\DBAL\Logger\Psr3QueryLogger;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Class DoctrineDBALProvider
 * @package Jadob\Bridge\Doctrine\DBAL\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DoctrineDBALProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return 'doctrine_dbal';
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\DBAL\DBALException
     * @throws \RuntimeException
     */
    public function register($config)
    {
        if (!isset($config['connections']) || \count($config['connections']) === 0) {
            throw new \RuntimeException('You should provide at least one connection in config.doctrine_dbal node.');
        }

        $services = [];
        $services[EventManager::class] = $eventManager = new EventManager();


        $services['doctrine.dbal.logger'] = function (ContainerInterface $container) {
            $logger = new Logger('doctrine_dbal');
            $handler = new StreamHandler($container->get(BootstrapInterface::class)->getLogsDir() . '/dbal.log');
            $logger->pushHandler($handler);

            return $logger;
        };

        $services['doctrine.dbal.query.logger'] = function (ContainerInterface $container) {
            $logger = new Psr3QueryLogger(
                $container->get('doctrine.dbal.logger')
            );

            return $logger;
        };

        $services[Configuration::class] = function (ContainerInterface $container) {
            $configuration = new Configuration();
            $configuration->setSQLLogger($container->get('doctrine.dbal.query.logger'));

            return $configuration;
        };

        foreach ($config['connections'] as $connectionName => $configuration) {
            $services['doctrine.dbal.' . $connectionName] = function (ContainerInterface $container) use ($configuration, $eventManager) {
                return DriverManager::getConnection(
                    $configuration,
                    $container->get(Configuration::class),
                    $eventManager
                );
            };

        }

        return $services;
    }

    /**
     * {@inheritdoc}
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    public function onContainerBuild(Container $container, $config)
    {
        if ($container->has('console')) {

            $helperSet = new HelperSet([
                'db' => new ConnectionHelper($container->get('doctrine.dbal.default'))
            ]);

            /** @var Application $console */
            $console = $container->get('console');

            $console->setHelperSet($helperSet);
            $console->addCommands([
                new ReservedWordsCommand(),
                new RunSqlCommand()
            ]);
        }
    }


    public function getDefaultConfiguration(): array
    {
        return [
            /**
             * DBAL logger configuration
             */
            'logging' => [
                /**
                 * If true, DBAL will log all queries to %LOG_DIR%/dbal.log file, otherwise it will use default logfile
                 */
                'use_external_file' => false,
                /**
                 * Pass all StreamHandler IDs from container that DBAL Logs will be sent too.
                 */
                'log_to' => []
            ]
        ];
    }
}