<?php

declare(strict_types=1);

namespace Jadob\EventStore\Storage;

use Doctrine\DBAL\Connection;

//use Jadob\EventSourcing\EventStore\Storage\EventStorageInterface;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DBALEventStorage implements EventStorageInterface
{
    //default
    public const STRATEGY_TABLE_PER_AGGREGATE = 1;
    public const STRATEGY_TABLE_PER_TYPE = 2;
    public const STRATEGY_ONE_TABLE_FOR_ALL = 3;

    /**
     * @var array{aggregate_table_name?: string, aggregate_table_prefix?: string, bulk_inserts?: false, events_table_name?: string, strategy?: int}
     */
    protected array $config = [];

    /**
     * DBALEventStorage constructor.
     *
     * @param Connection                 $dbal
     * @param array<string, string|bool> $config
     */
    public function __construct(protected Connection $dbal, array $config = [])
    {
        $this->config = [
            /**
             * How events should be stored in database?
             *
             * @var int
             */
            'strategy' => self::STRATEGY_TABLE_PER_AGGREGATE,
            /**
             * If true, all events will be persisted in once SQL. Otherwise - one SQL per event.
             *
             * @var bool
             */
            'bulk_inserts' => false,
            /**
             * What is the name for aggregates metadata table?
             *
             * @var string
             */
            'aggregate_table_name' => 'aggregates_metadata',
            /**
             * What is the name for aggregate events table?
             *
             * @var string
             */
            'events_table_name' => 'aggregate_events',
            /**
             * Works only with self::STRATEGY_TABLE_PER_AGGREGATE strategy.
             * Value prepended to aggregateId in table name.
             *
             * @var string
             */
            'aggregate_table_prefix' => 'aggregate_'
        ];
    }
}