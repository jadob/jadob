<?php

namespace Jadob\Bridge\Doctrine\DBAL\Configuration;

final class DbalConnectionConfig
{
    private(set) string $dsn;

    private(set) bool $queryLoggerEnabled = false;

    private(set) bool $default = false;

    /**
     * @var array<string, string>
     */
    private(set) array $mappingTypes = [];

    public function setAsDefault(): self
    {
        $this->default = true;
        return $this;
    }

    public function withDsn(
        string $dsn,
    ): self
    {
        $this->dsn = $dsn;
        return $this;
    }

    public function enableQueryLogger(): self
    {
        $this->queryLoggerEnabled = true;
        return $this;
    }

    public function withMappingType(
        string $dbType,
        string $doctrineType,

    )
    {

    }
}