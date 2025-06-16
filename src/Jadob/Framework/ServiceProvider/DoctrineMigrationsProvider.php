<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\EntityManager\ManagerRegistryEntityManager;
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
use Doctrine\Persistence\ManagerRegistry;
use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\Logger\LoggerFactory;
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
        $output[DependencyFactory::class] = static function (
            ContainerInterface $container,
            ManagerRegistry    $managerRegistry,
            LoggerFactory      $loggerFactory,
        ) use (
            $config
        ): DependencyFactory {
            $migrationConfigObj = new ConfigurationArray($config);

            return DependencyFactory::fromEntityManager(
                $migrationConfigObj,
                ManagerRegistryEntityManager::withSimpleDefault(
                    $managerRegistry,
                    $managerRegistry->getDefaultManagerName()
                ),
                $loggerFactory->getDefaultLogger()
            );
        };

        $output[DumpSchemaCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (DependencyFactory $dependencyFactory) {
                return new DumpSchemaCommand($dependencyFactory);
            }
        ];

        $output[DiffCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (DependencyFactory $dependencyFactory) {
                return new DiffCommand($dependencyFactory);
            }
        ];

        $output[ExecuteCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (DependencyFactory $dependencyFactory) {
                return new ExecuteCommand($dependencyFactory);
            }
        ];

        $output[LatestCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (DependencyFactory $dependencyFactory) {
                return new LatestCommand($dependencyFactory);
            }
        ];

        $output[ListCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (DependencyFactory $dependencyFactory) {
                return new ListCommand($dependencyFactory);
            }
        ];

        $output[MigrateCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (DependencyFactory $dependencyFactory) {
                return new MigrateCommand($dependencyFactory);
            }
        ];

        $output[RollupCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (DependencyFactory $dependencyFactory) {
                return new RollupCommand($dependencyFactory);
            }
        ];

        $output[StatusCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (DependencyFactory $dependencyFactory) {
                return new StatusCommand($dependencyFactory);
            }
        ];

        $output[SyncMetadataCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (DependencyFactory $dependencyFactory) {
                return new SyncMetadataCommand($dependencyFactory);
            }
        ];

        $output[VersionCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (DependencyFactory $dependencyFactory) {
                return new VersionCommand($dependencyFactory);
            }
        ];

        $output[GenerateCommand::class] = [
            'tags' => ['console.command'],
            'factory' => function (DependencyFactory $dependencyFactory) {
                return new GenerateCommand($dependencyFactory);
            }
        ];

        return $output;
    }


    public function getParentServiceProviders(): array
    {
        return [
            DoctrineORMProvider::class
        ];
    }
}