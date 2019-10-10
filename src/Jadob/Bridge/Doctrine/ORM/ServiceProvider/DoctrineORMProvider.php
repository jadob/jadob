<?php

namespace Jadob\Bridge\Doctrine\ORM\ServiceProvider;

use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Psr\Container\ContainerInterface;
use ReflectionException;
use RuntimeException;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

/**
 * Class DoctrineORMProvider
 * @package Jadob\Bridge\Doctrine\ORM\ServiceProvider
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
     * @TODO add support for multiple cache types
     * {@inheritdoc}
     * @throws ReflectionException
     */
    public function register($config)
    {
        /**
         * Entity paths must be defined, otherwise there is no sense to load rest of ORM
         */
        if (!isset($config['managers'])) {
            throw new RuntimeException('There is no "managers" section in config.doctrine_orm node.');
        }

        $this->registerAnnotations();
        $services = [];

        foreach ($config['managers'] as $managerName => $managerConfig) {

            $services['doctrine.orm.' . $managerName] = function (ContainerInterface $container) use ($managerName, $managerConfig) {
                $cacheDir = $container->get(BootstrapInterface::class)->getCacheDir()
                    . '/'
                    . $container->get('kernel')->getEnv()
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

                foreach ($managerConfig['entity_paths'] as $path) {
                    $entityPaths[] = $container->get(BootstrapInterface::class)->getRootDir() . '/' . ltrim($path, '/');
                }

                $configuration = new Configuration();
                $configuration->setMetadataCacheImpl($metadataCache);
                $configuration->setHydrationCacheImpl($hydrationCache);
                $configuration->setQueryCacheImpl($queryCache);
                $configuration->setMetadataDriverImpl(
                    new AnnotationDriver(
                        new CachedReader(new AnnotationReader(), $annotationCache),
                        $entityPaths
                    )
                );

                $configuration->setProxyNamespace('Doctrine\ORM\Proxies');
                $configuration->setProxyDir($cacheDir . '/Doctrine/ORM/Proxies');
                $configuration->setAutoGenerateProxyClasses(true);

                /**
                 * Build EntityManager
                 */
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
                'db' => new ConnectionHelper($container->get('doctrine.dbal.default')),
                'em' => new EntityManagerHelper($container->get('doctrine.orm.default'))
            ]);

            $console->setHelperSet($helperSet);

            ConsoleRunner::addCommands($console);
        }
    }

    /**
     * @throws ReflectionException
     */
    protected function registerAnnotations()
    {
        $configurationClassDirectory = \dirname((new \ReflectionClass(Configuration::class))->getFileName());
        require_once $configurationClassDirectory . '/Mapping/Driver/DoctrineAnnotations.php';
    }
}