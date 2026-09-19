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
    ) {
    }

    public function getDefaultConnectionName(): string
    {
        // TODO: Implement getDefaultConnectionName() method.
    }

    public function getConnection(?string $name = null): object
    {
        // TODO: Implement getConnection() method.
    }

    public function getConnections(): array
    {
        // TODO: Implement getConnections() method.
    }

    public function getConnectionNames(): array
    {
        // TODO: Implement getConnectionNames() method.
    }
}