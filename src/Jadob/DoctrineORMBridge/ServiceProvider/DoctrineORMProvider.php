<?php

namespace Jadob\DoctrineORMBridge\ServiceProvider;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\PhpFileCache;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Tools\Setup;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\DoctrineORMBridge\UserProvider\DoctrineORMUserProviderFactory;
use Jadob\Security\Auth\AuthenticationManager;
use Jadob\Stdlib\StaticEnvironmentUtils;
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
    public function register(Container $container, $config)
    {
        /**
         * Entity paths must be defined, otherwise there is no sense to load rest of ORM
         */
        if (!isset($config['entity_paths'])) {
            throw new \RuntimeException('Entity paths is not defined,');
        }

        /**
         * Paths should be relative, beginning from project root dir.
         * Rest of path will be concatenated below.
         */
        $entityPaths = [];

        foreach ($config['entity_paths'] as $path) {
            //@TODO: trim beginning slash from any $path if present
            $entityPaths[] = $container->get('bootstrap')->getRootDir() . '/' . $path;
        }

        $isDevMode = !$container->get('kernel')->isProduction();
        $cacheDir = $container->get('bootstrap')->getCacheDir()
            . '/'
            . $container->get('kernel')->getEnv()
            . '/doctrine';


        /**
         * Add cache to ORM.
         * file - PhpFileCache
         * filesystem - FilesystemCache
         */
        if (isset($config['cache'])) {

            if (!isset($config['cache']['type'])) {
                throw new \RuntimeException('Cache type is not provided.');
            }

            $cacheConfig = $config['cache'];

            switch (strtolower($cacheConfig['type'])) {
                case 'file':
                    $cache = new PhpFileCache($cacheDir . '/cache');
                    break;
                default:
                    $cache = new ArrayCache();
                    break;
            }

        }

        $this->registerAnnotations();

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
            $container->get('doctrine.dbal'),
            $configuration
        );

        $container->add('doctrine.orm', $entityManager);

        /** @var AuthenticationManager $authManager */
        $authManager = $container->get('auth.authentication.manager');

        $authManager->addUserProviderFactory(
            'doctrine',
            new DoctrineORMUserProviderFactory($entityManager)
        );


        if (!StaticEnvironmentUtils::isCli()) {
            return;
        }

        /**
         * If in CLI mode, add console helper
         */

        /** @var Application $console */
        $console = $container->get('console');

        //@TODO: maybe we should add db helper set in DoctrineDBALBridge?
        $helperSet = new HelperSet([
            'db' => new ConnectionHelper($container->get('doctrine.dbal')),
            'em' => new EntityManagerHelper($entityManager)
        ]);

        $console->setHelperSet($helperSet);

        ConsoleRunner::addCommands($console);
    }

    /**
     * @throws \ReflectionException
     */
    protected function registerAnnotations()
    {
        $configurationClassDirectory = \dirname((new \ReflectionClass(Configuration::class))->getFileName());

        require_once $configurationClassDirectory . '/Mapping/Driver/DoctrineAnnotations.php';
    }

}