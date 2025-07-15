<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\DBAL\ServiceProvider;

use Closure;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\DBAL\Types\Type;
use Doctrine\Persistence\ConnectionRegistry;
use InvalidArgumentException;
use Jadob\Bridge\Doctrine\Common\ServiceProvider\DoctrineCommonServiceProvider;
use Jadob\Bridge\Doctrine\DBAL\Configuration\DbalConfiguration;
use Jadob\Bridge\Doctrine\Persistence\DoctrineManagerRegistry;
use Jadob\Bridge\ProxyManager\ServiceProvider\ProxyManagerProvider;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use LogicException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use ProxyManager\Proxy\VirtualProxyInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use RuntimeException;
use function count;

/**
 * Class DoctrineDBALProvider
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DoctrineDBALProvider implements ServiceProviderInterface, ParentServiceProviderInterface, ConfigObjectProviderInterface
{
    private const CONNECTION_SERVICE_NAME_FORMAT = 'doctrine.dbal.%s';

    /**
     * {@inheritdoc}
     */
    public function getConfigNode(): ?string
    {
        return 'doctrine_dbal';
    }

    /**
     * @param ContainerInterface $container
     * @phpstan-param DbalConfiguration $config
     *
     * @return (EventManager|Closure|Closure|Closure|Closure)[]
     *
     * @throws Exception
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function register(ContainerInterface $container, null|object|array $config = null): array
    {
        $this->registerTypes($config->getTypes());
        $connections = $config->getConnections();

        if (count($connections) === 0) {
            throw new LogicException(
                'You should provide at least one connection in "doctrine_dbal" config node.'
            );
        }

        $services = [];
        /** @var DoctrineManagerRegistry $managerRegistry */
        $managerRegistry = $container->get(ConnectionRegistry::class);


        $logger = new Logger('doctrine_dbal');
        $handler = new StreamHandler($container->get(BootstrapInterface::class)->getLogsDir() . '/dbal.log');
        $logger->pushHandler($handler);


        $configurationObject = new Configuration();
        /**
         * @TODO: this is a good place to use container tags!
         * doctrine/dbal does not seem to have method to add single middleware, there is no better thing to do than
         * just tag middlewares and get a collection of them here.
         */
        $configurationObject->setMiddlewares([
            new Middleware($logger),
        ]);


        $defaultConnectionName = null;
        foreach ($connections as $connectionName => $configuration) {
            $serviceName = sprintf(self::CONNECTION_SERVICE_NAME_FORMAT, $connectionName);
            if ($configuration['default']) {
                if ($defaultConnectionName !== null) {
                    throw new InvalidArgumentException('There are at least two default DBAL connections defined! Check your configuration file.');
                }

                $defaultConnectionName = $connectionName;
                $managerRegistry->setDefaultConnectionName($defaultConnectionName);
            }

            $connection = DriverManager::getConnection(
                $this->resolveConnectionConfiguration($configuration['configuration']),
                $configurationObject
            );

            foreach ($config->getMappingTypes() as $sqlType => $doctrineType) {
                $connection
                    ->getDatabasePlatform()
                    ->registerDoctrineTypeMapping($sqlType, $doctrineType);
            }


            $managerRegistry->addConnection(
                $serviceName,
                $connection
            );

            $services[$serviceName] = function () use ($managerRegistry, $serviceName): \Doctrine\DBAL\Connection {
                return $managerRegistry->getConnection($serviceName);
            };
        }

        if ($defaultConnectionName === null) {
            throw new InvalidArgumentException('There is no default DBAL connections defined! Check your configuration file.');
        }

        return $services;
    }

    public function getParentServiceProviders(): array
    {
        return [
            DoctrineCommonServiceProvider::class
        ];
    }

    public function getDefaultConfigurationObject(): object
    {
        return new DbalConfiguration();
    }


    /**
     * @param array<string, class-string> $types
     * @return void
     * @throws Exception
     */
    private function registerTypes(array $types): void
    {
        foreach ($types as $name => $type) {
            Type::addType($name, $type);

        }
    }


    private function resolveConnectionConfiguration(array $configuration): array
    {
        if (array_key_exists('dsn', $configuration)) {
            return (new DsnParser())->parse($configuration['dsn']);
        }

        return $configuration;

    }
}