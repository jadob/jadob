<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Migrations\ServiceProvider;

use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Jadob\Bridge\Doctrine\Dbal\Configuration\DbalConfiguration;
use Jadob\Bridge\Doctrine\Dbal\ServiceProvider\DoctrineDbalProvider;
use Jadob\Bridge\Doctrine\EventManager\ServiceProvider\DoctrineEventManagerServiceProvider;
use Jadob\Bridge\Doctrine\Orm\Configuration\DoctrineOrmConfig;
use Jadob\Bridge\Doctrine\Orm\ServiceProvider\DoctrineOrmProvider;
use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Compiler\ContainerCompiler;
use Jadob\Container\Config\InMemoryConfigNodeFinder;
use Jadob\Container\ServiceGraphContainer;
use Jadob\Framework\ServiceProvider\LoggerServiceProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

class DoctrineMigrationsProviderTest extends TestCase
{

    #[Group('migrations')]
    public function testInstantiatingWithMinimalConfig(): void
    {
        $builder = new ContainerBuilder();
        $builder->registerServiceProvider(new LoggerServiceProvider());
        $builder->registerServiceProvider(new DoctrineOrmProvider());
        $builder->registerServiceProvider(new DoctrineDbalProvider());
        $builder->registerServiceProvider(new DoctrineEventManagerServiceProvider());
        $builder->registerServiceProvider(new DoctrineMigrationsProvider());

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

        $graph = $compiler->compile($builder);

        $container = new ServiceGraphContainer(
            $graph
        );

        self::assertTrue($container->has(MigrateCommand::class));

    }

}