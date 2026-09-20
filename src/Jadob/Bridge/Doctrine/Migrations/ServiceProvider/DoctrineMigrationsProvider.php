<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Migrations\ServiceProvider;

use Doctrine\Migrations\Configuration\Configuration;
use Doctrine\Migrations\Configuration\EntityManager\ManagerRegistryEntityManager;
use Doctrine\Migrations\Configuration\Migration\ExistingConfiguration;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command\DoctrineCommand;
use Doctrine\Persistence\ManagerRegistry;
use Jadob\Bridge\Doctrine\Migrations\Configuration\MigrationsConfiguration;
use Jadob\Bridge\Doctrine\Migrations\Configuration\MigrationsTableStorageConfiguration;
use Jadob\Bridge\Doctrine\Orm\ServiceProvider\DoctrineOrmProvider;
use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;
use ReflectionClass;

final readonly class DoctrineMigrationsProvider implements ServiceProviderInterface, ParentServiceProviderInterface, ConfigObjectProviderInterface
{
    public function getConfigNode(): string
    {
        return 'doctrine_migrations';
    }

    /**
     * @param ContainerBuilderInterface $builder
     * @param MigrationsConfiguration $config
     * @return void
     */
    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        $builder
            ->set(DependencyFactory::class)
            ->withFactory(static function (
                ContainerInterface $container,
                ManagerRegistry $managerRegistry,
                LoggerFactory $loggerFactory,
            ) use (
                $config
            ): DependencyFactory {
                $migrationConfigObj = new Configuration();

                $migrationConfigObj->setMigrationOrganization(
                    Configuration::VERSIONS_ORGANIZATION_NONE
                );
                
                $migrationConfigObj->setAllOrNothing(
                    $config->allOrNothing
                );
                
                $migrationConfigObj->setCheckDatabasePlatform(
                    $config->checkDatabasePlatform
                );
                
                $migrationConfigObj->setCustomTemplate(
                    $config->customTemplate
                );
                
                foreach ($config->migrationPaths as $namespace => $path) {
                    $migrationConfigObj->addMigrationsDirectory(
                        namespace: $namespace,
                        path: $path
                    );
                }

                return DependencyFactory::fromEntityManager(
                    new ExistingConfiguration($migrationConfigObj),
                    ManagerRegistryEntityManager::withSimpleDefault(
                        $managerRegistry,
                        $managerRegistry->getDefaultManagerName()
                    ),
                    $loggerFactory->getDefaultLogger()
                );
            });

        $this->registerConsoleCommands($builder);
    }


    public function getParentServiceProviders(): array
    {
        return [
            DoctrineOrmProvider::class
        ];
    }

    public function getDefaultConfigurationObject(): ConfigNodeInterface
    {
        return new MigrationsConfiguration(
            migrationsTable: new MigrationsTableStorageConfiguration()
        );
    }

    private function registerConsoleCommands(
        ContainerBuilder $builder,
    ): void {
        $builder
            ->configureNamespaceScan()
            ->autowire()
            ->withTag('console.command')
            ->withClassNameSuffix('Command')
            ->in(
                dirname((new ReflectionClass(DoctrineCommand::class))->getFileName())
            );
    }
}