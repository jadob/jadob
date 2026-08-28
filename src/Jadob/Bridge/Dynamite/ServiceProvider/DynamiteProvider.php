<?php
declare(strict_types=1);

namespace Jadob\Bridge\Dynamite\ServiceProvider;

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
        ?ConfigNodeInterface $config = null
    ): void {
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


        $instanceServiceIds = [];
        foreach ($config['tables'] as $instanceName => $table) {
            $instanceDef = static function (ContainerInterface $container) use ($table, $useCache): ItemManager {
                $clientId = DynamoDbClient::class;

                if (isset($table['connection'])) {
                    $clientId = $table['connection'];
                }

                $tableSchema = new TableSchema(
                    $table['table_name'],
                    $table['partition_key_name'],
                    $table['sort_key_name'],
                    $table['indexes'] ?? []
                );

                return new ItemManager(
                    $container->get($clientId),
                    $tableSchema,
                    $container->get('dynamite.item_mapping_reader'),
                    $table['managed_objects'],
                    $container->get(ItemSerializer::class),
                    $container->get(KeyFormatResolver::class),
                    $container->get('dynamite.logger'),
                    new Marshaler()
                );
            };

            $instanceServiceId = sprintf('dynamite.%s', $instanceName);
            $instanceServiceIds[$instanceName] = $instanceServiceId;
            $output[$instanceServiceId] = $instanceDef;
        }




        $output[ItemManagerRegistry::class] = static function (ContainerInterface $container) use ($instanceServiceIds): ItemManagerRegistry {
            $registry = new ItemManagerRegistry();

            foreach ($instanceServiceIds as $instanceName => $instanceServiceId) {
                $registry->addManagedTable($container->get($instanceServiceId));
            }

            return $registry;
        };
    }

    public function getDefaultConfigurationObject(): ConfigNodeInterface
    {
        return new DynamiteConfig();
    }
}