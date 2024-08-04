<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\ORM\ServiceProvider;

use Closure;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\Persistence\ManagerRegistry;
use InvalidArgumentException;
use Jadob\Bridge\Doctrine\DBAL\ServiceProvider\DoctrineDBALProvider;
use Jadob\Bridge\Doctrine\Persistence\DoctrineManagerRegistry;
use Jadob\Bridge\Doctrine\Persistence\ServiceProvider\PersistenceProvider;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ParentProviderInterface;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\Core\Kernel;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use RuntimeException;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Adds Doctrine ORM features to Jadob Framework.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DoctrineORMProvider implements ServiceProviderInterface, ParentProviderInterface
{

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
     * @psalm-return array<string, \Closure(ContainerInterface):EntityManager>
     */
    public function register($config)
    {
        /**
         * Entity paths must be defined, otherwise there is no sense to load rest of ORM
         */
        if (!isset($config['managers'])) {
            throw new RuntimeException('There is no "managers" section in config.doctrine_orm node.');
        }

        $services = [];
        $defaultManagerName = null;

        foreach ($config['managers'] as $managerName => $managerConfig) {
            if(!is_string($managerName)) {
                throw new \LogicException('All Doctrine ORM Manager names must be an string.');
            }

            if (isset($configuration['default']) && (bool) $configuration['default']) {
                if ($defaultManagerName !== null) {
                    throw new InvalidArgumentException('There are at least two default ORM connections defined! Check your configuration file.');
                }

                $defaultManagerName = $managerName;
            }

            $services['doctrine.orm.' . $managerName] = function (ContainerInterface $container)
            use (
                $managerName,
                $managerConfig,
                &$annotationsRegistered
            ): EntityManager {
                $isProd = $container->get(Kernel::class)->getEnv() === 'prod';

                $cacheDir = $container->get(BootstrapInterface::class)->getCacheDir()
                    . '/'
                    . $container->get(Kernel::class)->getEnv()
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

                $metadataCache = new FilesystemCache($cacheDir . '/metadata');
                $hydrationCache = new FilesystemCache($cacheDir . '/hydration');
                $queryCache = new FilesystemCache($cacheDir . '/query');
                $annotationCache = new FilesystemCache($cacheDir . '/annotation');

                if (!$isProd) {
                    $metadataCache = new ArrayCache();
                    $annotationCache = new ArrayCache();
                }

                foreach ($managerConfig['entity_paths'] as $path) {
                    $entityPaths[] = $container->get(BootstrapInterface::class)->getRootDir() . '/' . ltrim($path, '/');
                }


                $configuration = new Configuration();
                $configuration->setMetadataCacheImpl($metadataCache);
                $configuration->setHydrationCacheImpl($hydrationCache);
                $configuration->setQueryCacheImpl($queryCache);
                $configuration->setMetadataDriverImpl(
                    new AttributeDriver(
                        $entityPaths
                    )
                );

                $configuration->setProxyNamespace('Doctrine\ORM\Proxies');
                $configuration->setProxyDir($cacheDir . '/Doctrine/ORM/Proxies');
                $configuration->setAutoGenerateProxyClasses(true);

                return EntityManager::create(
                    $container->get('doctrine.dbal.' . $managerName),
                    $configuration,
                    $container->get(EventManager::class)
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
        /**
         * @TODO: how about providing multiple database console command by providing additional argument
         * (eg. --conn=<connection_name>)
         */
        if ($container->has('console')) {
            /** @var Application $console */
            $console = $container->get('console');

            //@TODO: maybe we should add db helper set in DoctrineDBALBridge?
            $helperSet = new HelperSet([
                'em' => new EntityManagerHelper($container->get('doctrine.orm.default'))
            ]);

            $console->setHelperSet($helperSet);

            ConsoleRunner::addCommands($console);
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
    public function getParentProviders(): array
    {
        return [
            PersistenceProvider::class,
            DoctrineDBALProvider::class
        ];
    }
}