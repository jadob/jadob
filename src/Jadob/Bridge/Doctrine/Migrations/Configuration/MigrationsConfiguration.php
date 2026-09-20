<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Migrations\Configuration;

use Jadob\Container\Config\ConfigNodeInterface;

final class MigrationsConfiguration implements ConfigNodeInterface
{
    /**
     * @var array<string, string>
     */
    private(set) array $migrationPaths = [];

    private(set) ?string $customTemplate = null;

    private(set) bool $allOrNothing = false;

    private(set) bool $checkDatabasePlatform = false;

    public function __construct(
        private(set) MigrationsTableStorageConfiguration $migrationsTable
    ) {
    }

    public function configureMigrationTable(): MigrationsTableStorageConfiguration
    {
        return $this->migrationsTable;
    }

    public function withMigrationPath(
        string $namespace,
        string $path
    ): self {
        $this->migrationPaths[$namespace] = $path;

        return $this;
    }

    public function withCustomTemplate(
        string $template,
    ): self {
        $this->customTemplate = $template;
    }

    public function withAllOrNothing(bool $allOrNothing = true): self
    {
        $this->allOrNothing = $allOrNothing;

        return $this;
    }

    public function withCheckDatabasePlatform(bool $checkDatabasePlatform = true): self
    {
        $this->checkDatabasePlatform = $checkDatabasePlatform;

        return $this;
    }
}