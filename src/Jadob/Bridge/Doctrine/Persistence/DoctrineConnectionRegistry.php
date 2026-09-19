<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Persistence;

use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ConnectionRegistry;

final readonly class DoctrineConnectionRegistry implements ConnectionRegistry
{
    /**
     * @param array<string, Connection> $connections
     */
    public function __construct(
        private array $connections,
        private string $defaultConnectionName
    ) {
    }

    public function getDefaultConnectionName(): string
    {
        return $this->defaultConnectionName;
    }

    public function getConnection(?string $name = null): object
    {
        return $this->connections[$name ?? $this->getDefaultConnectionName()];
    }

    public function getConnections(): array
    {
        return $this->connections;
    }

    public function getConnectionNames(): array
    {
        return array_keys($this->connections);
    }
}