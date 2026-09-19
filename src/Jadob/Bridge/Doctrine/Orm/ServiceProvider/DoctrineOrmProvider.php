<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Orm\ServiceProvider;

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\ORM\Tools\Console\Command\AbstractEntityManagerCommand;
use Doctrine\ORM\Tools\Console\EntityManagerProvider;
use Doctrine\Persistence\ManagerRegistry;
use InvalidArgumentException;
use Jadob\Bridge\Doctrine\Dbal\ServiceProvider\DoctrineDbalProvider;
use Jadob\Bridge\Doctrine\Orm\Configuration\DoctrineOrmConfig;
use Jadob\Bridge\Doctrine\ORM\Console\MultipleEntityManagerProvider;
use Jadob\Bridge\Doctrine\Persistence\DoctrineManagerRegistry;
use Jadob\Bridge\Doctrine\Persistence\ObjectManagerFactory;
use Jadob\Bridge\Doctrine\Persistence\ObjectManagerFactoryInterface;
use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\Attribute\InjectParameter;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use LogicException;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * @license MIT
 */
final readonly class DoctrineOrmProvider implements ServiceProviderInterface, ParentServiceProviderInterface, ConfigObjectProviderInterface
{
    private const MANAGER_SERVICE_NAME_FORMAT = 'doctrine.orm.%s';

    private const MANAGER_FACTORY_SERVICE_NAME_FORMAT = 'doctrine.orm.factory.%s';

    private const CONFIGURATION_SERVICE_NAME_FORMAT = 'doctrine.orm.configuration.%s';

    /**
     * {@inheritdoc}
     */
    public function getConfigNode(): string
    {
        return 'doctrine_orm';
    }

    /**
     * @param ContainerBuilderInterface $builder
     * @param DoctrineOrmConfig|null $config
     * @return void
     */
    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        if (!($config instanceof DoctrineOrmConfig)) {
            throw new InvalidArgumentException('Config node passed to DoctrineORMProvider must be of type DoctrineOrmConfig.');
        }

        $builder->requireParameter('cache_dir');
        $builder->requireParameter('app_env');
        $builder->requireParameter('root_dir');

        /** @var array<string, array{factory: string, manager: string}> $managerServiceIds */
        $managerServiceIds = [];

        /** @var string|null $defaultManagerServiceId */
        $defaultManagerServiceId = null;
        $defaultManagerName = null;

        foreach ($config->managers as $managerName => $managerConfig) {
            if (!is_string($managerName)) {
                throw new LogicException('All Doctrine ORM Manager names must be an string.');
            }

            $configurationServiceName = sprintf(self::CONFIGURATION_SERVICE_NAME_FORMAT, $managerName);
            $managerServiceName = sprintf(self::MANAGER_SERVICE_NAME_FORMAT, $managerName);
            $factoryServiceName = sprintf(self::MANAGER_FACTORY_SERVICE_NAME_FORMAT, $managerName);

            if ($managerConfig->default) {
                if ($defaultManagerServiceId !== null) {
                    throw new InvalidArgumentException('There are at least two default ORM connections defined! Check your configuration file.');
                }

                $defaultManagerServiceId = $managerServiceName;
                $defaultManagerName = $managerName;
            }

            $managerConfigFactory = function (
                #[InjectParameter('root_dir')]
                string $rootDir,
                #[InjectParameter('cache_dir')]
                string $cacheDir,
                #[InjectParameter('app_env')]
                string $appEnv,
            ) use ($managerConfig): Configuration {
                $config = new Configuration();
                $config->setMetadataDriverImpl(
                    new AttributeDriver(
                        paths: array_map(
                            fn(string $path): string => sprintf(
                                '%s/%s',
                                rtrim($rootDir, '/'),
                                ltrim($path, '/')
                            ),
                            $managerConfig->paths
                        )
                    )
                );

                $isDevMode = $appEnv === 'dev';

                if ($isDevMode) {
                    $cache = new ArrayAdapter();
                } else {
                    $cache = new FilesystemAdapter(
                        namespace: 'doctrine_orm',
                        directory: sprintf('%s/doctrine_orm', $cacheDir),
                    );
                }

                $config->setHydrationCache($cache);
                $config->setMetadataCache($cache);
                $config->setQueryCache($cache);
                $config->setProxyNamespace('Doctrine\ORM\Proxies');
                $config->setProxyDir(sprintf('%s/doctrine_orm_proxies', $cacheDir));
                $config->setAutoGenerateProxyClasses(true);
                $config->enableNativeLazyObjects(true);

                return $config;
            };

            $builder
                ->set($configurationServiceName)
                ->withFactory($managerConfigFactory);

            $managerFactory = function (
                #[InjectParameter('cache_dir')]
                string $cacheDir,
                Connection $connection,
                Configuration $config,
                EventManager $eventManager,
            ): ObjectManagerFactoryInterface {
                return new ObjectManagerFactory(
                    fn() => new EntityManager(
                        conn: $connection,
                        config: $config,
                        eventManager: $eventManager,
                    )
                );
            };

            $builder
                ->set($factoryServiceName)
                ->withTag('doctrine.orm.entity_manager_factory')
                ->withFactory($managerFactory)
                ->withArgument('connection', Reference::service($managerConfig->dbalConnectionName))
                ->withArgument('config', Reference::service($configurationServiceName));

            $managerServiceIds[$managerName] = [
                'factory' => $factoryServiceName,
                'manager' => $managerServiceName,
            ];
        }

        if ($defaultManagerServiceId === null) {
            throw new LogicException('Default entity manager is not configured.');
        }

        $builder
            ->alias(
                EntityManagerInterface::class,
                $defaultManagerServiceId
            );

        $builder
            ->set(ManagerRegistry::class)
            ->withFactory(
                function (ContainerInterface $container) use ($defaultManagerName, $managerServiceIds) {
                    return new DoctrineManagerRegistry(
                        entityManagerFactories: array_map(
                            function (array $serviceIds) use ($container): ObjectManagerFactoryInterface {
                                return $container->get($serviceIds['factory']);
                            },
                            $managerServiceIds
                        ),
                        defaultManagerName: $defaultManagerName,
                        connectionRegistry: $container->get(ManagerRegistry::class)
                    );
                }
            );

        foreach ($managerServiceIds as $name => $serviceId) {
            $builder
                ->set($serviceId['manager'])
                ->withTag('doctrine.orm.entity_manager')
                ->withFactory(
                    function (ManagerRegistry $managerRegistry) use ($name) {
                        return $managerRegistry->getManager($name);
                    }
                );
        }

        $builder
            ->set(
                EntityManagerProvider::class,
                MultipleEntityManagerProvider::class
            )
            ->autowire();

        $this->registerOrmConsoleCommands($builder);
    }


    private function registerOrmConsoleCommands(
        ContainerBuilder $builder
    ): void {
        $builder
            ->configureNamespaceScan()
            ->withTag('console.command')
            ->withClassNameSuffix('Command')
            ->autowire()
            ->in(
                dirname((new ReflectionClass(AbstractEntityManagerCommand::class))->getFileName())
            );
    }

    public function getDefaultConfigurationObject(): ConfigNodeInterface
    {
        return new DoctrineOrmConfig();
    }

    /**
     * @return array
     * @psalm-return class-string[]
     */
    public function getParentServiceProviders(): array
    {
        return [
            DoctrineDbalProvider::class
        ];
    }
}