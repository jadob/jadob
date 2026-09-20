<?php declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Migrations\Configuration;

final class MigrationsTableStorageConfiguration
{
    public function __construct(
        private(set) string $tableName = 'doctrine_migration_versions',
        private(set) string $versionColumnName = 'version',
        private(set) int $versionColumnLength = 500,
        private(set) string $executedAtColumnName = 'executed_at',
        private(set) string $executionTimeColumnName = 'execution_time',
    ) {
    }

    public function withTableName(string $tableName): self
    {
        $this->tableName = $tableName;

        return $this;
    }
    
    public function withVersionColumnName(string $columnName): self
    {
        $this->versionColumnName = $columnName;

        return $this;
    }
    
    public function withVersionColumnLength(int $versionColumnLength): self
    {
        $this->versionColumnLength = $versionColumnLength;

        return $this;
    }
    
    public function withExecutedAtColumnName(string $executedAtColumnName): self
    {
        $this->executedAtColumnName = $executedAtColumnName;

        return $this;
    }
    
    public function withExecutionTimeColumnName(string $executionTimeColumnName): self
    {
        $this->executionTimeColumnName = $executionTimeColumnName;

        return $this;
    }
}