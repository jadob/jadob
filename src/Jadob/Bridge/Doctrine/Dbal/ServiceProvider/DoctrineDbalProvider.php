<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Dbal\ServiceProvider;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\DBAL\Types\Type;
use Doctrine\Persistence\ConnectionRegistry;
use InvalidArgumentException;
use Jadob\Bridge\Doctrine\DBAL\Configuration\DbalConfiguration;
use Jadob\Bridge\Doctrine\EventManager\ServiceProvider\DoctrineEventManagerServiceProvider;
use Jadob\Bridge\Doctrine\Persistence\DoctrineConnectionRegistry;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\Logger\LoggerFactory;
use LogicException;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use function count;

/**
 * Class DoctrineDBALProvider
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DoctrineDbalProvider implements ServiceProviderInterface, ParentServiceProviderInterface, ConfigObjectProviderInterface
{
    private const CONNECTION_SERVICE_NAME_FORMAT = 'doctrine.dbal.%s';
    private const CONFIGURATION_SERVICE_NAME_FORMAT = 'doctrine.dbal.configuration.%s';

    /**
     * {@inheritdoc}
     */
    public function getConfigNode(): string
    {
        return 'doctrine_dbal';
    }

    /**
     * @param ContainerBuilderInterface $builder
     * @param DbalConfiguration $config
     * @return void
     * @throws Exception
     */
    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        $this->registerTypes($config->types);
        $connections = $config->connections;

        if (count($connections) === 0) {
            throw new LogicException(
                'You should provide at least one connection in "doctrine_dbal" config node.'
            );
        }

        $builder
            ->set('doctrine.dbal.logger', LoggerInterface::class)
            ->withFactory(static function (LoggerFactory $loggerFactory): LoggerInterface {
                return $loggerFactory
                    ->getLoggerForChannel('doctrine_dbal');
            });

        /** @var array<string, string> $connectionServiceIds */
        $connectionServiceIds = null;
        /** @var string|null $defaultConnectionName */
        $defaultConnectionName = null;
        foreach ($connections as $connectionName => $configuration) {
            $configurationServiceName = sprintf(self::CONFIGURATION_SERVICE_NAME_FORMAT, $connectionName);
            $serviceName = sprintf(self::CONNECTION_SERVICE_NAME_FORMAT, $connectionName);
            $connectionServiceIds[$connectionName] = $serviceName;

            if ($configuration->default) {
                if ($defaultConnectionName !== null) {
                    throw new InvalidArgumentException('There are at least two default DBAL connections defined! Check your configuration file.');
                }
                $defaultConnectionName = $serviceName;
            }

            $configurationObjectFactory = function (): Configuration {
                return new Configuration();
            };

            $builder
                ->set($configurationServiceName, Configuration::class)
                ->withFactory($configurationObjectFactory);

            $factory = static function (Configuration $dbalConfig) use ($configuration): Connection {
                return DriverManager::getConnection(
                    params: new DsnParser()->parse($configuration->dsn),
                    config: $dbalConfig,
                );
            };

            $builder
                ->set($serviceName)
                ->withFactory($factory)
                ->withArgument(
                    'configuration',
                    Reference::service($configurationServiceName)
                );
        }

        if ($defaultConnectionName === null) {
            throw new InvalidArgumentException('There is no default DBAL connections defined! Check your configuration file.');
        }

        $builder
            ->alias(
                $defaultConnectionName,
                Connection::class
            );

        $builder
            ->set(ConnectionRegistry::class)
            ->withFactory(function (ContainerInterface $container) use ($connectionServiceIds) {
                return new DoctrineConnectionRegistry(
                    connections: array_map(
                        function (string $serviceName) use ($container): Connection {
                            return $container->get($serviceName);
                        },
                        $connectionServiceIds
                    )
                );
            });
    }

    public function getParentServiceProviders(): array
    {
        return [
            DoctrineEventManagerServiceProvider::class
        ];
    }

    public function getDefaultConfigurationObject(): ConfigNodeInterface
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
}