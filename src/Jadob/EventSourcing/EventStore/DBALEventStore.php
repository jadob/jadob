<?php

declare(strict_types=1);

namespace Jadob\EventSourcing\EventStore;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Jadob\EventSourcing\AbstractDomainEvent;
use Jadob\EventSourcing\Aggregate\AbstractAggregateRoot;
use Jadob\EventSourcing\EventStore\Exception\EventStoreException;
use Jadob\EventSourcing\EventStore\Storage\DBALConnectionUtility;
use PDO;
use Psr\Log\LoggerInterface;
use ReflectionException;
use Throwable;
use function count;
use function get_class;
use function str_replace;

/**
 * @deprecated
 * @TODO   this one should be EventStorage related, and EventStore should be separated
 * @author takbardzoimiki <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DBALEventStore implements EventStoreInterface
{
    /**
     * unsupported Yet
     * All events are stored in single table.
     *
     * @var int
     */
    public const STRATEGY_ALL_IN_ONE = 1;

    /**
     * Each aggregate lives in his own tables.
     *
     * @var int
     */
    public const STRATEGY_ONE_PER_STREAM = 2;

    /**
     * Unsupported yet
     * There is a table for each aggregate *type*.
     *
     * eg. There will be a one table for CAT Aggregate, and another for RABBIT Aggregate.
     *
     * @var int
     */
    public const STRATEGY_ONE_PER_TYPE = 3;

    /**
     * How does the table with aggregates information is called
     * @var string
     */
    public const DEFAULT_METADATA_TABLE_NAME = 'aggregates_metadata';

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ProjectionManager
     */
    protected $projectionManager;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var PayloadSerializer
     */
    protected $payloadSerializer;

    /**
     * @var DBALConnectionUtility
     */
    protected $utility;

    /**
     * DBALEventStore constructor.
     *
     * @param Connection $connection
     * @param LoggerInterface $logger
     * @param ProjectionManager|null $projectionManager
     * @param EventDispatcher|null $eventDispatcher
     */
    public function __construct(
        Connection $connection,
        LoggerInterface $logger,
        ?ProjectionManager $projectionManager = null,
        ?EventDispatcher $eventDispatcher = null
    )
    {
        $this->connection = $connection;
        $this->logger = $logger;
        $this->payloadSerializer = new PayloadSerializer();
        $this->projectionManager = $projectionManager ?? new ProjectionManager();
        $this->eventDispatcher = $eventDispatcher ?? new EventDispatcher();
        $this->utility = new DBALConnectionUtility($connection);
    }

    /**
     * @param AbstractAggregateRoot $aggregateRoot
     * @throws EventStoreException
     * @throws DBALException
     * @throws ReflectionException
     */
    public function saveAggregateRoot(AbstractAggregateRoot $aggregateRoot)
    {
        $aggregateId = $aggregateRoot->getAggregateId();
        $events = $aggregateRoot->popUncomittedEvents();
        $aggregateType = get_class($aggregateRoot);
        $timestamp = (new \DateTime())->format('Y-m-d H:i:s');

        $this->ensureAggregatesMetadataTableExists();
        $this->ensureThereIsATableForAggregate($aggregateId);

        $aggregateExists = $this->hasAggregateMetadata($aggregateId);
        $this->connection->beginTransaction();

        if (!$aggregateExists) {
            $this->connection->insert(
                self::DEFAULT_METADATA_TABLE_NAME,
                [
                    'aggregate_type' => $aggregateType,
                    'aggregate_id' => $aggregateId,
                    'timestamp' => $timestamp
                ]
            );
        }

        foreach ($events as $event) {
            $eventType = get_class($event);
            $eventVersion = $event->getAggregateVersion();
            $payload = $this->payloadSerializer->serialize($event->toArray());

            //TODO: LOCK TABLES na czas insertu?
            //@TODO Bulk inserts? event id isnt needed
            $this->connection->insert(
                'aggregate_' . $this->fixTableName($aggregateId),
                [
                    'event_type' => $eventType,
                    'aggregate_version' => $eventVersion,
                    'payload' => $payload,
                    'timestamp' => $timestamp
                ]
            );
        }

        try {
            $this->connection->commit();
        } catch (Throwable $e) {
            $this->connection->rollBack();
            throw new EventStoreException(
                'An exception occured during aggregate commit: ' . $e->getMessage() . '. call getPrevious() on this to get more information',
                0,
                $e
            );
        }

        //update snapshot here

        foreach ($events as $event) {
            //TODO drop ProjectionManager as a separate class and replace it with another EventDispatcher instance
            $this->projectionManager->emit($event);
            $this->eventDispatcher->emit($event);
        }

    }

    public function hasAggregateMetadata(string $aggregateId): bool
    {
        $qb = $this->connection->createQueryBuilder()
            ->select('*')
            ->from(self::DEFAULT_METADATA_TABLE_NAME)
            ->where('aggregate_id = :uuid')
            ->setParameter('uuid', $aggregateId);

        $result = $qb->execute()->fetchAll(PDO::FETCH_ASSOC);

        return count($result) !== 0;
    }

    /**
     * @param string $streamName
     * @return AbstractDomainEvent[]
     */
    public function getStream(string $streamName): array
    {
        //@TODO może jakiś iterator, który będzie ściągał np 120 obiektów na raz i w razie potrzeby doładowywał nowe?
        //@TODO sortowanie po wersji
        $qb = $this->connection->createQueryBuilder()
            ->select('*')
            ->from(self::DEFAULT_METADATA_TABLE_NAME)
            ->where('aggregate_id = :uuid')
            ->orderBy('aggregate_version')
            ->setParameter('uuid', $streamName);

        return $qb->execute()->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Checks only for table existence, not for his structure nor data.
     * If not present in schema, it will be created (see DBALConnectionUtility::createMetadataTable())
     *
     * @throws DBALException
     */
    protected function ensureAggregatesMetadataTableExists(): void
    {
        $exists = $this->utility->metadataTableExists();

        if (!$exists) {
            $this->utility->createMetadataTable();
        }
    }

    /**
     * @param string $aggregateId
     * @throws DBALException
     */
    public function ensureThereIsATableForAggregate(string $aggregateId): void
    {
        $aggregateId = $this->fixTableName($aggregateId);
        $tableName = 'aggregate_' . $aggregateId;
        $exists = $this->utility->aggregateTableExists($tableName);

        if (!$exists) {
            $this->utility->createAggregateTable($tableName);
        }
    }


    public function fixTableName(string $tableName): string
    {
        return str_replace('-', '_', $tableName);
    }
}