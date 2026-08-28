<?php
declare(strict_types=1);

namespace Jadob\Bridge\Dynamite\ServiceProvider;

use Aws\DynamoDb\DynamoDbClient;
use Jadob\Container\Config\ConfigNodeInterface;

final class DynamiteConfig implements ConfigNodeInterface
{
    /**
     * @param bool $mappingCacheEnabled
     * @param array<TableConfig> $tableConfigs
     */
    public function __construct(
        private(set) bool $mappingCacheEnabled = false,
        private(set) string $dynamoDbClientId = DynamoDbClient::class,
        private(set) array $tableConfigs = []
    ) {
    }

    public function enableMappingCache(): self
    {
        $this->mappingCacheEnabled = true;

        return $this;
    }

    public function configureTable(): TableConfig
    {
        $tableConfig = new TableConfig();
        $this->tableConfigs[] = $tableConfig;

        return $tableConfig;
    }
}