<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

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
use Jadob\Bridge\Doctrine\Annotations\ServiceProvider\DoctrineAnnotationsProvider;
use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class DynamiteProvider implements ServiceProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigNode(): ?string
    {
        return 'dynamite';
    }

    /**
     * @inheritDoc
     */
    public function register(ContainerInterface $container, null|object|array $config = null): array
    {
        $output = [];

        $output['dynamite.logger'] = static function (ContainerInterface $container): LoggerInterface {
            /** @noinspection MissingService */
            return new Logger('dynamite', [$container->get('logger.handler.default')]);
        };

        $useCache = $config['cache'] ?? false;
        $output['dynamite.item_mapping_reader'] = function (ContainerInterface $container) use ($useCache): ItemMappingReader {
            if ($useCache) {
                return new CachedItemMappingReader(
                    $container->get(CacheInterface::class)
                );
            }

            return new ItemMappingReader();
        };

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

                /** @noinspection MissingService */
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

        $output[ItemSerializer::class] = static function (): ItemSerializer {
            return new ItemSerializer();
        };

        $output[KeyFormatResolver::class] = static function (): KeyFormatResolver {
            $kfr = new KeyFormatResolver();

            $kfr->addFilter('upper', new UppercaseFilter());
            $kfr->addFilter('lower', new LowercaseFilter());
            $kfr->addFilter('ucfirst', new UppercaseFirstFilter());
            $kfr->addFilter('md5', new Md5Filter());
            $kfr->addFilter('nodash', new NoDashFilter());
            return $kfr;
        };

        $output[ItemManagerRegistry::class] = static function (ContainerInterface $container) use ($instanceServiceIds): ItemManagerRegistry {
            $registry = new ItemManagerRegistry();

            foreach ($instanceServiceIds as $instanceName => $instanceServiceId) {
                $registry->addManagedTable($container->get($instanceServiceId));
            }

            return $registry;
        };
        return $output;
    }

    /**
     * @inheritDoc
     */
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}