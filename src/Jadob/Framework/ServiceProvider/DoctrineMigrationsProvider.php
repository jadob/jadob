<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\RollupCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use LogicException;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

class DoctrineMigrationsProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return 'doctrine_migrations';
    }

    public function register(ContainerInterface $container, null|object|array $config = null): array
    {
        $output = [];
        $ormMigrations = $config['orm'];
        foreach ($ormMigrations as $managerName => $migrationConfig) {
            $factory = static function (ContainerInterface $container) use ($managerName, $migrationConfig): DependencyFactory {
                $migrationConfigObj = new ConfigurationArray($migrationConfig);
                $em = $container->get(sprintf('doctrine.orm.%s', $managerName));

                return DependencyFactory::fromEntityManager(
                    $migrationConfigObj,
                    new ExistingEntityManager($em)
                );
            };


            $output[sprintf('doctrine.migrations.%s', $managerName)] = $factory;
        }

        return $output;
    }

    public function onContainerBuild(Container $container, $config)
    {
        if ($container->has('console')) {
            /** @var Application $console */
            $console = $container->get('console');

            if (!isset($config['orm'])) {
                throw new LogicException('You need to configure ORM to use migrations.');
            }

            $ormManagers = array_keys($config['orm']);
            foreach ($ormManagers as $managerName) {
                /** @var DependencyFactory $depFactory */
                $depFactory = $container->get(sprintf('doctrine.migrations.%s', $managerName));

                $console->add(new DumpSchemaCommand($depFactory, sprintf('migrations:%s:dump-schema', $managerName)));
                $console->add(new DiffCommand($depFactory, sprintf('migrations:%s:diff', $managerName)));
                $console->add(new ExecuteCommand($depFactory, sprintf('migrations:%s:execute', $managerName)));
                $console->add(new GenerateCommand($depFactory, sprintf('migrations:%s:generate', $managerName)));
                $console->add(new LatestCommand($depFactory, sprintf('migrations:%s:latest', $managerName)));
                $console->add(new ListCommand($depFactory, sprintf('migrations:%s:list', $managerName)));
                $console->add(new MigrateCommand($depFactory, sprintf('migrations:%s:migrate', $managerName)));
                $console->add(new RollupCommand($depFactory, sprintf('migrations:%s:rollup', $managerName)));
                $console->add(new StatusCommand($depFactory, sprintf('migrations:%s:status', $managerName)));
                $console->add(new SyncMetadataCommand($depFactory, sprintf('migrations:%s:sync-metadata-storage', $managerName)));
                $console->add(new VersionCommand($depFactory, sprintf('migrations:%s:version', $managerName)));
            }
        }
    }

    public function getParentServiceProviders(): array
    {
        return [
            DoctrineORMProvider::class
        ];
    }
}