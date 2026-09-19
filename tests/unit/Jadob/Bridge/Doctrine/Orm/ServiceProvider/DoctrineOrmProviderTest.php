<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Orm\ServiceProvider;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Jadob\Bridge\Doctrine\Dbal\Configuration\DbalConfiguration;
use Jadob\Bridge\Doctrine\Dbal\ServiceProvider\DoctrineDbalProvider;
use Jadob\Bridge\Doctrine\EventManager\ServiceProvider\DoctrineEventManagerServiceProvider;
use Jadob\Bridge\Doctrine\Orm\Configuration\DoctrineOrmConfig;
use Jadob\Bridge\Doctrine\Persistence\DoctrineManagerRegistry;
use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Compiler\ContainerCompiler;
use Jadob\Container\Config\InMemoryConfigNodeFinder;
use Jadob\Container\ServiceGraphContainer;
use PHPUnit\Framework\TestCase;

final class DoctrineOrmProviderTest extends TestCase
{
    public function testInstantiatingProviderWithMinimalConfig(): void
    {
        $builder = new ContainerBuilder();
        $builder->registerServiceProvider(new DoctrineOrmProvider());
        $builder->registerServiceProvider(new DoctrineDbalProvider());
        $builder->registerServiceProvider(new DoctrineEventManagerServiceProvider());

        $builder->addFallbackParameter('app_env', 'dev');
        $builder->addFallbackParameter('cache_dir', '/tmp');
        $builder->addFallbackParameter('root_dir', '/tmp');

        $nodeFinder = new InMemoryConfigNodeFinder(
            [
                'doctrine_dbal' => [
                    function (DbalConfiguration $config) {
                        $config
                            ->configureConnection('dbal_test')
                            ->withDsn('sqlite3::memory:')
                            ->setAsDefault();
                        return $config;
                    }
                ],
                'doctrine_orm' => [
                    function (DoctrineOrmConfig $config) {
                        $config
                            ->configureManager('orm_test')
                            ->setAsDefault()
                            ->withDbalConnectionName('dbal_test');
                        return $config;
                    }
                ]
            ]
        );

        $compiler = new ContainerCompiler($nodeFinder);

        $container = new ServiceGraphContainer(
            $compiler->compile($builder),
        );

        /** @var ManagerRegistry $registry */
        $registry = $container->get(ManagerRegistry::class);

        self::assertInstanceOf(DoctrineManagerRegistry::class, $registry);
        self::assertInstanceOf(EntityManagerInterface::class, $registry->getManager('orm_test'));
        self::assertSame('orm_test', $registry->getDefaultManagerName());
    }
}