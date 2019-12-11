<?php

namespace Jadob\Bridge\Doctrine\ODM\ServiceProvider;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateHydratorsCommand;
use Doctrine\ODM\MongoDB\Tools\Console\Command\GeneratePersistentCollectionsCommand;
use Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateProxiesCommand;
use Doctrine\ODM\MongoDB\Tools\Console\Command\QueryCommand;
use Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\CreateCommand;
use Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\DropCommand;
use Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\ShardCommand;
use Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\UpdateCommand;
use Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\ValidateCommand;
use Doctrine\ODM\MongoDB\Tools\Console\Helper\DocumentManagerHelper;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use MongoDB\Client;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

/**
 * Class DoctrineODMProvider
 *
 * @package Jadob\Bridge\Doctrine\ODM\ServiceProvider
 * @author  pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DoctrineODMProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return 'doctrine_odm';
    }

    /**
     * {@inheritdoc}
     *
     * @throws \ReflectionException
     */
    public function register($config)
    {

        if(!\extension_loaded('mongodb')) {
            throw new \RuntimeException('DoctrineODMProvider needs to have "mongodb" extension installed.');
        }

        $services = [];

        $vendorDirPath = \dirname((new \ReflectionClass(AnnotationRegistry::class))->getFileName(), 7);

        $classLoader = include $vendorDirPath.'/autoload.php';
        AnnotationRegistry::registerLoader([$classLoader, 'loadClass']);

        $services[Configuration::class] = static function (ContainerInterface $container) use ($config) {
            $defaultDatabase = $config['default_database'];

            $bootstrap = $container->get(BootstrapInterface::class);
            $configuration = new Configuration();

            $configuration->setDefaultDB($defaultDatabase);
            $configuration->setAutoGenerateProxyClasses(Configuration::AUTOGENERATE_FILE_NOT_EXISTS);
            $configuration->setAutoGenerateHydratorClasses(Configuration::AUTOGENERATE_FILE_NOT_EXISTS);

            $configuration->setProxyDir($bootstrap->getCacheDir() . '/doctrine/odm/Proxies');
            $configuration->setProxyNamespace('DoctrineODMProxies');

            $configuration->setHydratorDir($bootstrap->getCacheDir() . '/doctrine/odm/Hydrators');
            $configuration->setHydratorNamespace('DoctrineODMHydrators');

            $configuration->setMetadataDriverImpl(
                $container->get(AnnotationDriver::class)
            );

            \spl_autoload_register($configuration->getProxyManagerConfiguration()->getProxyAutoloader());

            return $configuration;
        };


        $services[AnnotationDriver::class] = static function (ContainerInterface $container) use ($config) {
            $documentPaths = $config['document_paths'];
            $fullDocumentPaths = [];

            foreach ($documentPaths as $documentPath) {
                $fullDocumentPaths[] = $container->get(BootstrapInterface::class)->getRootDir().'/'.ltrim($documentPath, '/');
            }

            return AnnotationDriver::create($fullDocumentPaths);
        };

        $services[Client::class] = static function () use ($config) {

            $dsn = $config['dsn'];
            $driverOptions = $config['driver_options'] ?? [];
            $driverOptions['typeMap'] = DocumentManager::CLIENT_TYPEMAP;

            return new Client($dsn, [], $driverOptions);


        };

        $services[DocumentManager::class] = static function (ContainerInterface $container) use ($config) {

            return DocumentManager::create(
                $container->get(Client::class),
                $container->get(Configuration::class)
            );
        };

        return $services;
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        if($container->has('console')) {
            $odmHelper = new DocumentManagerHelper($container->get(DocumentManager::class));

            /**
 * @var Application $console 
*/
            $console = $container->get('console');

            $console->getHelperSet()->set($odmHelper, 'documentManager');

            $console->addCommands(
                [
                new CreateCommand(),
                new DropCommand(),
                new ShardCommand(),
                new UpdateCommand(),
                new ValidateCommand(),
                new GenerateHydratorsCommand(),
                new GeneratePersistentCollectionsCommand(),
                new GenerateProxiesCommand(),
                new QueryCommand()
                ]
            );


        }
    }
}