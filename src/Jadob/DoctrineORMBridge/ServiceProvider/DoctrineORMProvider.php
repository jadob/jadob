<?php

namespace Jadob\DoctrineORMBridge\ServiceProvider;

use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Tools\Setup;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
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
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function register(Container $container, $config)
    {
        $configuration = Setup::createAnnotationMetadataConfiguration(
            $config['entity_paths'],
            !$container->get('kernel')->isProduction()
        );

        $entityManager = EntityManager::create(
            $container->get('doctrine.dbal'),
            $configuration
        );

        $container->add('doctrine.orm', $entityManager);

        if (!StaticEnvironmentUtils::isCli()) {
            return;
        }

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
}