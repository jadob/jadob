<?php


namespace Jadob\EventSourcing\EventStore\DynamoDb;


class EventStoreTableConfiguration
{
    private string $tableName;
    private string $partitionKeyName;
    private string $sortKeyName;

    /**
     * EventStoreTableConfiguration constructor.
     * @param string $tableName
     * @param string $partitionKeyName
     * @param string $sortKeyName
     */
    public function __construct(string $tableName, string $partitionKeyName = 'pk', string $sortKeyName = 'sk')
    {
        $this->tableName = $tableName;
        $this->partitionKeyName = $partitionKeyName;
        $this->sortKeyName = $sortKeyName;
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