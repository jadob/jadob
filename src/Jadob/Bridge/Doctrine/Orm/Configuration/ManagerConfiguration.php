<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Orm\Configuration;

final class ManagerConfiguration
{
    private(set) bool $default = false;
    private(set) string $dbalConnectionName;
    /**
     * Paths should be relative, beginning from project root dir.
     * Rest of path will be concatenated below.
     *
     * @var list<string>
     */
    private(set) array $entityPaths = [];

    public function setAsDefault(): self
    {
        $this->default = true;

        return $this;
    }

    public function withDbalConnectionName(
        string $connectionName,
    ): self {
        $this->dbalConnectionName = $connectionName;

        return $this;
    }

    public function withEntityPath(string $path): self
    {
        $this->entityPaths[] = $path;
    }
}