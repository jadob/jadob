<?php
declare(strict_types=1);

namespace Jadob\Bridge\Dynamite\ServiceProvider;


use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Marshaler;
use Dynamite\Dynamite;
use Dynamite\ItemManager;
use Dynamite\ItemManagerRegistry;
use Dynamite\ItemSerializer;
use Dynamite\Mapping\CachedItemMappingReader;
use Dynamite\Mapping\ItemMappingReader;
use Dynamite\PrimaryKey\Filter\LowercaseFilter;
use Dynamite\PrimaryKey\Filter\Md5Filter;
use Dynamite\PrimaryKey\Filter\UppercaseFilter;
use Dynamite\PrimaryKey\Filter\UppercaseFirstFilter;
use Dynamite\PrimaryKey\KeyFormatResolver;
use Dynamite\TableConfiguration;
use Dynamite\TableSchema;
use Jadob\Bridge\Doctrine\Annotations\ServiceProvider\DoctrineAnnotationsProvider;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ParentProviderInterface;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class DynamiteProvider implements ServiceProviderInterface, ParentProviderInterface
{

    /**
     * @inheritDoc
     */
    public function getConfigNode()
    {
        return 'dynamite';
    }

    /**
     * @inheritDoc
     */
    public function register($config)
    {
        $output = [];
        $annotationReaderId = 'doctrine.annotations.reader';
        if (isset($config['annotation_reader_id'])) {
            $annotationReaderId = $config['annotation_reader_id'];
        }

        $output['dynamite.logger'] = static function (ContainerInterface $container): LoggerInterface {
            /** @noinspection MissingService */
            return new Logger('dynamite', [$container->get('logger.handler.default')]);
        };

        $useCache = $config['cache'] ?? false;
        $output['dynamite.item_mapping_reader'] = function (ContainerInterface $container) use ($useCache, $annotationReaderId): ItemMappingReader {
            if ($useCache) {
                return new CachedItemMappingReader(
                    $container->get($annotationReaderId),
                    $container->get(CacheInterface::class)
                );
            }

            return new ItemMappingReader(
                $container->get($annotationReaderId)
            );
        };

        $instanceServiceIds = [];
        foreach ($config['tables'] as $instanceName => $table) {
            $instanceDef = static function (ContainerInterface $container) use ($table, $annotationReaderId, $useCache): ItemManager {
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
                    new Marshaler(),
                    $container->get($annotationReaderId),
                );
            };

            $instanceServiceId = sprintf('dynamite.%s', $instanceName);
            $instanceServiceIds[$instanceName] = $instanceServiceId;
            $output[$instanceServiceId] = $instanceDef;
        }

        $output[ItemSerializer::class] = static function(): ItemSerializer {
            return new ItemSerializer();
        };

        $output[KeyFormatResolver::class] = static function(): KeyFormatResolver {
            $kfr = new KeyFormatResolver();

            $kfr->addFilter('upper', new UppercaseFilter());
            $kfr->addFilter('lower', new LowercaseFilter());
            $kfr->addFilter('ucfirst', new UppercaseFirstFilter());
            $kfr->addFilter('md5', new Md5Filter());
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

    /**
     * @inheritDoc
     */
    public function getParentProviders(): array
    {
        return [
            DoctrineAnnotationsProvider::class
        ];
    }
}