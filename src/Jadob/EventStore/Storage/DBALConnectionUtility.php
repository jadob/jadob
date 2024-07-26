<?php

declare(strict_types=1);

namespace Jadob\EventStore\Storage;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Types;
use Jadob\EventStore\DBALEventStore;

/**
 * Provides support for schema-related operations like table exists etc.
 * Warning: Implementation tested only with MySQL Percona, other RDBMS and "clear" MySQL needs to be checked
 *
 * @internal
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DBALConnectionUtility
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var bool
     */
    protected $metadataTableExists;

    /**
     * DBALConnectionUtility constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string|null $tableName
     * @return bool
     */
    public function metadataTableExists(?string $tableName = null): bool
    {
        if ($tableName === null) {
            $tableName = DBALEventStore::DEFAULT_METADATA_TABLE_NAME;
        }

        if ($this->metadataTableExists === null) {
            $this->metadataTableExists = $this->connection->getSchemaManager()->tablesExist($tableName);
        }

        return $this->metadataTableExists;
    }

    /**
     * @param string|null $tableName
     * @throws DBALException
     */
    public function createMetadataTable(?string $tableName = null): void
    {
        if ($tableName === null) {
            $tableName = DBALEventStore::DEFAULT_METADATA_TABLE_NAME;
        }

        $table = new Table($tableName);
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true]);
        $table->addColumn('aggregate_id', Types::STRING, ['length' => 36]);
        $table->addColumn('aggregate_type', Types::STRING);
        $table->addColumn('timestamp', Types::DATETIME_IMMUTABLE);
        $table->setComment('Event Store Metadata Table, created automatically by jadob/event-sourcing');
        $table->setPrimaryKey(['id']);

        $this->connection->getSchemaManager()->createTable($table);
        $this->metadataTableExists = true;
    }

    /**
     * @param string $aggregateTable
     * @return bool
     */
    public function aggregateTableExists(string $aggregateTable): bool
    {
        return $this->connection->getSchemaManager()->tablesExist($aggregateTable);
    }


    /**
     * @param string $tableName
     * @throws DBALException
     */
    public function createAggregateTable(string $tableName): void
    {
        $table = new Table($tableName);
        $table->addColumn('id', Types::INTEGER, ['autoincrement' => true]);
        $table->addColumn('event_type', Types::STRING);
        $table->addColumn('aggregate_version', Types::INTEGER, ['unsigned' => true]);
        $table->addColumn('payload', Types::TEXT);
        $table->addColumn('timestamp', Types::DATETIME_IMMUTABLE);
        $table->setPrimaryKey(['id']);

        $this->connection->getSchemaManager()->createTable($table);
    }
}