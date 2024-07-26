<?php
declare(strict_types=1);


namespace Jadob\EventStore;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Types;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @internal
 * @license proprietary
 */
class DbalConnectionUtility
{
    /**
     * @var bool
     */
    protected bool $metadataTableExists = false;

    /**
     * DBALConnectionUtility constructor.
     * @param Connection $connection
     */
    public function __construct(protected Connection $connection)
    {
    }

    /**
     * @param string|null $tableName
     * @return bool
     */
    public function metadataTableExists(?string $tableName = null): bool
    {
        if ($tableName === null) {
            $tableName = DbalEventStore::DEFAULT_METADATA_TABLE_NAME;
        }

        if ($this->metadataTableExists === false) {
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
            $tableName = DbalEventStore::DEFAULT_METADATA_TABLE_NAME;
        }

        $table = new Table($tableName);
        $table->addColumn('id', Types::BIGINT, ['autoincrement' => true, 'unsigned' => true]);
        $table->addColumn('aggregate_id', Types::STRING, ['length' => 36]);
        $table->addColumn('aggregate_type', Types::STRING);
        $table->addColumn('timestamp', Types::BIGINT, ['unsigned' => true]);
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
        $table->addColumn('id', Types::BIGINT, ['autoincrement' => true, 'unsigned' => true]);
        $table->addColumn('event_type', Types::STRING);
        $table->addColumn('aggregate_version', Types::INTEGER, ['unsigned' => true]);
        $table->addColumn('payload', Types::TEXT);
        $table->addColumn('timestamp', Types::BIGINT, ['unsigned' => true]);
        $table->setPrimaryKey(['id']);

        $this->connection->getSchemaManager()->createTable($table);
    }
}