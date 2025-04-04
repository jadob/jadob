<?php

declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Closure;
use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\Persistence\ManagerRegistry;
use InvalidArgumentException;
use Jadob\Bridge\Doctrine\ORM\Console\MultipleEntityManagerProvider;
use Jadob\Bridge\Doctrine\Persistence\DoctrineManagerRegistry;
use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use LogicException;
use ProxyManager\FileLocator\FileLocator;
use ProxyManager\GeneratorStrategy\FileWriterGeneratorStrategy;
use Psr\Container\ContainerInterface;
use RuntimeException;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Adds Doctrine ORM features to Jadob Framework.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DoctrineORMProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    public function __construct(
        private string $env,
    ) {
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
     * @psalm-return array<string, Closure(ContainerInterface):EntityManager>
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

            if (isset($configuration['default']) && (bool) $configuration['default']) {
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

        return $services;
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        /**
         * @TODO: how about providing multiple database console command by providing additional argument
         * (eg. --conn=<connection_name>)
         */
        if ($container->has('console')) {
            /** @var Application $console */
            $console = $container->get('console');

            //@TODO: maybe we should add db helper set in DoctrineDBALBridge?
            $helperSet = new HelperSet([]);

            $console->setHelperSet($helperSet);

            ConsoleRunner::addCommands(
                $console,
                $container->get(MultipleEntityManagerProvider::class)
            );
        }


        /** @var DoctrineManagerRegistry $managerRegistry */
        $managerRegistry = $container->get(ManagerRegistry::class);
        foreach ($config['managers'] as $connectionName => $configuration) {
            $serviceName = sprintf('doctrine.orm.%s', $connectionName);

            $managerRegistry->addManager(
                $connectionName,
                $container->get($serviceName)
            );

            if ($configuration['default']) {
                $managerRegistry->setDefaultManagerName($connectionName);
            }
        }
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