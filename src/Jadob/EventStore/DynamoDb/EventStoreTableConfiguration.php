<?php
declare(strict_types=1);


namespace Jadob\EventStore\DynamoDb;

class EventStoreTableConfiguration
{
    /**
     * EventStoreTableConfiguration constructor.
     * @param string $tableName
     * @param string $partitionKeyName
     * @param string $sortKeyName
     */
    public function __construct(private readonly string $tableName, private readonly string $partitionKeyName = 'pk', private readonly string $sortKeyName = 'sk')
    {
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @return string
     */
    public function getPartitionKeyName(): string
    {
        return $this->partitionKeyName;
    }

    /**
     * @return string
     */
    public function getSortKeyName(): string
    {
        return $this->sortKeyName;
    }
}