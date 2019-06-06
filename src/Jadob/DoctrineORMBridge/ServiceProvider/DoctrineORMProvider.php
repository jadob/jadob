<?php

namespace Jadob\DoctrineORMBridge\ServiceProvider;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\DoctrineORMBridge\Registry\ManagerRegistry;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Adds Doctrine ORM to Jadob.
 * @package Jadob\DoctrineORMBridge\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DoctrineORMProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return 'doctrine_orm';
    }

    /**
     * {@inheritdoc}
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function register($config)
    {
        return;
    }

    /**
     * @throws \ReflectionException
     */
    protected function registerAnnotations()
    {
        $configurationClassDirectory = \dirname((new \ReflectionClass(Configuration::class))->getFileName());
        require_once $configurationClassDirectory . '/Mapping/Driver/DoctrineAnnotations.php';
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     * @throws \ReflectionException
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function onContainerBuild(Container $container, $config)
    {

        /**
         * Entity paths must be defined, otherwise there is no sense to load rest of ORM
         */
        if (!isset($config['managers'])) {
            throw new \RuntimeException('There is no "managers" section in config.doctrine_orm node.');
        }

        /**
         * Add cache to ORM.
         * @TODO: add some cache types
         */
        if (isset($config['cache'])) {

            if (!isset($config['cache']['type'])) {
                throw new \RuntimeException('Cache type is not provided.');
            }

            $cacheConfig = $config['cache'];

            switch (strtolower($cacheConfig['type'])) {
                default:
                    $cache = new ArrayCache();
                    break;
            }

        }

        $isDevMode = !$container->get('kernel')->isProduction();
        $cacheDir = $container->get(BootstrapInterface::class)->getCacheDir()
            . '/'
            . $container->get('kernel')->getEnv()
            . '/doctrine';

        $this->registerAnnotations();

        $managerRegistry = new ManagerRegistry();
        $container->add('doctrine.orm.manager_registry', $managerRegistry);

        foreach ($config['managers'] as $managerName => $managerConfig) {

            /**
             * Paths should be relative, beginning from project root dir.
             * Rest of path will be concatenated below.
             */
            $entityPaths = [];

            /**
             * Entity paths must be defined, otherwise there is no sense to load rest of ORM
             */
            if (!isset($managerConfig['entity_paths'])) {
                throw new \RuntimeException('Entity paths section in ' . $managerName . ' are not defined');
            }

            foreach ($managerConfig['entity_paths'] as $path) {
                //@TODO: trim beginning slash from any $path if present
                $entityPaths[] = $container->get(BootstrapInterface::class)->getRootDir() . '/' . $path;
            }

            $configuration = new Configuration();
            $configuration->setMetadataCacheImpl($isDevMode ? new ArrayCache() : $cache);
            $configuration->setHydrationCacheImpl($isDevMode ? new ArrayCache() : $cache);
            $configuration->setQueryCacheImpl($isDevMode ? new ArrayCache() : $cache);
            $configuration->setMetadataDriverImpl(
                new AnnotationDriver(
                    new CachedReader(new AnnotationReader(), $cache),
                    $entityPaths
                )
            );

            $configuration->setProxyNamespace('Doctrine\ORM\Proxies');
            $configuration->setProxyDir($cacheDir . '/Doctrine/ORM/Proxies');
            $configuration->setAutoGenerateProxyClasses(true);

            /**
             * Build EntityManager
             */
            $entityManager = EntityManager::create(
                $container->get('doctrine.dbal.' . $managerName),
                $configuration,
                $container->get(EventManager::class)
            );

            $managerRegistry->addObjectManager($entityManager, $managerName);
            $container->add('doctrine.orm.' . $managerName, $entityManager);

        }

        /**
         * @TODO: how about providing multiple database console command by providing additional argument
         * (eg. --conn=<connection_name>)
         */
        if ($container->has('console')) {
            /** @var Application $console */
            $console = $container->get('console');

            //@TODO: maybe we should add db helper set in DoctrineDBALBridge?
            $helperSet = new HelperSet([
                'db' => new ConnectionHelper($container->get('doctrine.dbal.default')),
                'em' => new EntityManagerHelper($entityManager)
            ]);

            $console->setHelperSet($helperSet);

            ConsoleRunner::addCommands($console);
        }
    }
}