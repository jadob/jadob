<?php
declare(strict_types=1);

namespace Jadob\Bridge\Dynamite\ServiceProvider;

use _PHPStan_eca38da41\Nette\DI\Attributes\Inject;
use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Marshaler;
use Dynamite\ItemManager;
use Dynamite\ItemManagerRegistry;
use Dynamite\ItemSerializer;
use Dynamite\Mapping\CachedItemMappingReader;
use Dynamite\Mapping\ItemMappingReader;
use Dynamite\PrimaryKey\Filter\LowercaseFilter;
use Dynamite\PrimaryKey\Filter\Md5Filter;
use Dynamite\PrimaryKey\Filter\NoDashFilter;
use Dynamite\PrimaryKey\Filter\UppercaseFilter;
use Dynamite\PrimaryKey\Filter\UppercaseFirstFilter;
use Dynamite\PrimaryKey\KeyFormatResolver;
use Dynamite\TableSchema;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\Attribute\InjectService;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\Logger\LoggerFactory;
use LogicException;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

final readonly class DynamiteProvider implements ServiceProviderInterface, ConfigObjectProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigNode(): string
    {
        return 'dynamite';
    }


    /**
     * @param ContainerBuilderInterface $builder
     * @param DynamiteConfig|null $config
     * @return void
     */
    public function register(
        ContainerBuilderInterface $builder,
        ?ConfigNodeInterface      $config = null
    ): void
    {
        $builder->set('dynamite.logger', LoggerInterface::class)
            ->withFactory(
                function (LoggerFactory $loggerFactory): LoggerInterface {
                    return $loggerFactory->getLoggerForChannel('dynamite');
                }
            );

        $builder->set(Marshaler::class);
        $builder->set(ItemSerializer::class);
        $builder->set(ItemMappingReader::class);

        if ($config->mappingCacheEnabled) {
            if (interface_exists(CacheInterface::class) === false) {
                throw new LogicException('"symfony/cache" is required to enable caching!');
            }

            $builder
                ->replace(ItemMappingReader::class, CachedItemMappingReader::class)
                ->withArgument(
                    'cache',
                    Reference::service(CacheInterface::class)
                );
        }

        $builder->set(KeyFormatResolver::class)
            ->withFactory(
                static function (): KeyFormatResolver {
                    $resolver = new KeyFormatResolver();

                    /**
                     * @TODO: switch to tagged services
                     */
                    $resolver->addFilter('upper', new UppercaseFilter());
                    $resolver->addFilter('lower', new LowercaseFilter());
                    $resolver->addFilter('ucfirst', new UppercaseFirstFilter());
                    $resolver->addFilter('md5', new Md5Filter());
                    $resolver->addFilter('nodash', new NoDashFilter());

                    return $resolver;
                }
            );

        $itemManagerRegistryFactory = static function (
            ContainerInterface $container,
            ItemMappingReader  $itemMappingReader,
            ItemSerializer     $itemSerializer,
            #[InjectService('dynamite.logger')]
            LoggerInterface    $logger,
            KeyFormatResolver  $keyFormatResolver,
            Marshaler          $marshaler,
        ) use ($config): ItemManagerRegistry {
            $registry = new ItemManagerRegistry();

            foreach ($config->tableConfigs as $tableConfig) {
                $tableSchema = new TableSchema(
                    $tableConfig->tableName,
                    $tableConfig->partitionKeyName,
                    $tableConfig->sortKeyName,
                    $tableConfig->indexes
                );

                $registry->addManagedTable(
                    new ItemManager(
                        $container->get($config->dynamoDbClientId),
                        $tableSchema,
                        $itemMappingReader,
                        $tableConfig->managedObjects,
                        $itemSerializer,
                        $keyFormatResolver,
                        $logger,
                        $marshaler,
                    )
                );
            }

            return $registry;
        };

        $builder
            ->set(ItemManagerRegistry::class)
            ->withFactory($itemManagerRegistryFactory);
    }

    public function getDefaultConfigurationObject(): ConfigNodeInterface
    {
        return new DynamiteConfig();
    }
}