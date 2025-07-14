<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\ORM\ServiceProvider;

use Closure;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Console\Command\ClearCache\CollectionRegionCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\EntityRegionCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\QueryRegionCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand;
use Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand;
use Doctrine\ORM\Tools\Console\Command\InfoCommand;
use Doctrine\ORM\Tools\Console\Command\MappingDescribeCommand;
use Doctrine\ORM\Tools\Console\Command\RunDqlCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Doctrine\Persistence\ManagerRegistry;
use InvalidArgumentException;
use Jadob\Bridge\Doctrine\DBAL\ServiceProvider\DoctrineDBALProvider;
use Jadob\Bridge\Doctrine\ORM\Console\MultipleEntityManagerProvider;
use Jadob\Bridge\Doctrine\Persistence\DoctrineManagerRegistry;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\Framework\ServiceProvider\DoctrinePersistenceProvider;
use LogicException;
use ProxyManager\FileLocator\FileLocator;
use ProxyManager\GeneratorStrategy\FileWriterGeneratorStrategy;
use Psr\Container\ContainerInterface;
use RuntimeException;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Adds Doctrine ORM features to Jadob Framework.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DoctrineORMProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    public function __construct(
        private string $env,
    )
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigNode(): string
    {
        return 'doctrine_orm';
    }

    /**
     * @TODO add support for multiple cache types
     * {@inheritdoc}
     *
     * @return Closure[]
     *
     * @psalm-return Closure
     */
    public function register(ContainerInterface $container, array|null|object $config = null): array
    {
        /**
         * Entity paths must be defined, otherwise there is no sense to load rest of ORM
         */
        if (!isset($config['managers'])) {
            throw new RuntimeException('There is no "managers" section in config.doctrine_orm node.');
        }

        $services = [];
        $defaultManagerName = null;

        /**
         * @TODO: separate to another service provider
         */
        $cacheDir = $container->get(BootstrapInterface::class)->getCacheDir();
        $proxyManagerConfig = new \ProxyManager\Configuration();
        $proxyManagerCacheDir = sprintf('%s/%s', $cacheDir, $this->env);
        $proxyManagerFileLocator = new FileLocator(
            $proxyManagerCacheDir,
        );

        $proxyManagerConfig->setGeneratorStrategy(
            new FileWriterGeneratorStrategy(
                $proxyManagerFileLocator
            )
        );

        $proxyManagerConfig->setProxiesTargetDir($proxyManagerCacheDir);
        spl_autoload_register($proxyManagerConfig->getProxyAutoloader());


        $proxyManagerFactory = new \ProxyManager\Factory\LazyLoadingValueHolderFactory(
            $proxyManagerConfig
        );

        /** @var DoctrineManagerRegistry $registry */
        $registry = $container->get(ManagerRegistry::class);

        foreach ($config['managers'] as $managerName => $managerConfig) {
            if (!is_string($managerName)) {
                throw new LogicException('All Doctrine ORM Manager names must be an string.');
            }

            if (isset($configuration['default']) && (bool)$configuration['default']) {
                if ($defaultManagerName !== null) {
                    throw new InvalidArgumentException('There are at least two default ORM connections defined! Check your configuration file.');
                }

                $registry->setDefaultManagerName($managerName);
                $defaultManagerName = $managerName;
            }

            $env = $this->env;
            $registry->addManager(
                $managerName,
                $proxyManagerFactory->createProxy(
                    EntityManager::class,
                    static function (
                        &$wrappedObject,
                        $proxy,
                        $method,
                        $parameters,
                        &$initializer
                    ) use (
                        $container,
                        $managerConfig,
                        $managerName,
                        $cacheDir,
                        $env
                    ) {
                        $isProd = $env === 'prod';


                        $doctrineCacheDir =
                            $cacheDir
                            . '/'
                            . $env
                            . '/doctrine/' . $managerName;

                        /**
                         * Paths should be relative, beginning from project root dir.
                         * Rest of path will be concatenated below.
                         */
                        $entityPaths = [];

                        /**
                         * Entity paths must be defined, otherwise there is no sense to load rest of ORM
                         */
                        if (!isset($managerConfig['entity_paths'])) {
                            throw new RuntimeException('Entity paths section in "' . $managerName . '" manager are not defined');
                        }

                        $metadataCache = new FilesystemAdapter(
                            namespace: 'metadata',
                            directory: $doctrineCacheDir,

                        );

                        $hydrationCache = new FilesystemAdapter(
                            namespace: 'hydration',
                            directory: $doctrineCacheDir,
                        );

                        $queryCache = new FilesystemAdapter(
                            namespace: 'query',
                            directory: $doctrineCacheDir,
                        );

                        if (!$isProd) {
                            $metadataCache = new ArrayAdapter();
                        }

                        foreach ($managerConfig['entity_paths'] as $path) {
                            $entityPaths[] = $container->get(BootstrapInterface::class)->getRootDir() . '/' . ltrim($path, '/');
                        }

                        $configuration = ORMSetup::createAttributeMetadataConfiguration(
                            $entityPaths,
                            isDevMode: $isProd === false
                        );

                        $configuration->setMetadataCache($metadataCache);
                        $configuration->setHydrationCache($hydrationCache);
                        $configuration->setQueryCache($queryCache);
                        $configuration->setMetadataDriverImpl(
                            new AttributeDriver(
                                $entityPaths
                            )
                        );

                        $configuration->setProxyNamespace('Doctrine\ORM\Proxies');
                        $configuration->setProxyDir($doctrineCacheDir . '/proxies');
                        $configuration->setAutoGenerateProxyClasses(true);

                        $stringFunctions = $managerConfig['string_functions'] ?? [];

                        foreach ($stringFunctions as $name => $function) {
                            $configuration->addCustomStringFunction($name, $function);
                        }

                        $wrappedObject = new EntityManager(
                            $container->get('doctrine.dbal.' . $managerName),
                            $configuration,
                            $container->get(EventManager::class)
                        );

                        $initializer = null; // turning off further lazy initialization

                        return true; // report success
                    }
                )
            );

            $services['doctrine.orm.' . $managerName] = function (ManagerRegistry $managerRegistry) use (
                $managerName,
            ): EntityManager {
                return $managerRegistry->getManager($managerName);
            };
        }

        $services[MultipleEntityManagerProvider::class] = function (ManagerRegistry $managerRegistry): MultipleEntityManagerProvider {
            return new MultipleEntityManagerProvider(
                $managerRegistry,
            );
        };

        $services[CollectionRegionCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new CollectionRegionCommand($entityManagerProvider);
            }
        ];

        $services[EntityRegionCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new EntityRegionCommand($entityManagerProvider);
            }
        ];

        $services[MetadataCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new MetadataCommand($entityManagerProvider);
            }
        ];

        $services[QueryCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new QueryCommand($entityManagerProvider);
            }
        ];

        $services[QueryRegionCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new QueryRegionCommand($entityManagerProvider);
            }
        ];

        $services[ResultCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new QueryRegionCommand($entityManagerProvider);
            }
        ];

        $services[CreateCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new QueryRegionCommand($entityManagerProvider);
            }
        ];

        $services[UpdateCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new QueryRegionCommand($entityManagerProvider);
            }
        ];

        $services[DropCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new QueryRegionCommand($entityManagerProvider);
            }
        ];
        $services[GenerateProxiesCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new GenerateProxiesCommand($entityManagerProvider);
            }
        ];
        $services[RunDqlCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new RunDqlCommand($entityManagerProvider);
            }
        ];
        $services[ValidateSchemaCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new ValidateSchemaCommand($entityManagerProvider);
            }
        ];
        $services[InfoCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new InfoCommand($entityManagerProvider);
            }
        ];
        $services[MappingDescribeCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (MultipleEntityManagerProvider $entityManagerProvider) {
                return new MappingDescribeCommand($entityManagerProvider);
            }
        ];


        return $services;
    }


    /**
     * @return array
     * @psalm-return class-string[]
     */
    public function getParentServiceProviders(): array
    {
        return [
            DoctrinePersistenceProvider::class,
            DoctrineDBALProvider::class
        ];
    }
}