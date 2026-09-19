<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Migrations\ServiceProvider;

use Doctrine\Migrations\Configuration\EntityManager\ManagerRegistryEntityManager;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command\DoctrineCommand;
use Doctrine\Persistence\ManagerRegistry;
use Jadob\Bridge\Doctrine\Migrations\Configuration\MigrationsConfiguration;
use Jadob\Bridge\Doctrine\ORM\ServiceProvider\DoctrineOrmProvider;
use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;

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
                $migrationConfigObj = new ConfigurationArray([]);

                return DependencyFactory::fromEntityManager(
                    $migrationConfigObj,
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
        return new MigrationsConfiguration();
    }

    private function registerConsoleCommands(
        ContainerBuilder $builder,
    ): void
    {
        $builder
            ->configureNamespaceScan()
            ->autowire()
            ->withTag('console.command')
            ->withClassNameSuffix('Command')
            ->in(
                dirname((new \ReflectionClass(DoctrineCommand::class))->getFileName())
            );
    }
}