<?php
declare(strict_types=1);

namespace Jadob\EventStore;

use DateTimeInterface;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Connection;
use Jadob\Aggregate\AbstractDomainEvent;
use Jadob\Aggregate\AggregateRootInterface;
use Jadob\EventStore\Exception\EventStoreException;
use JsonException;
use PDO;
use Prooph\ServiceBus\CommandBus;
use Psr\Log\LoggerInterface;
use Throwable;

class DbalEventStore implements EventStoreInterface
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
     * @var PayloadSerializer
     */
    protected PayloadSerializer $payloadSerializer;

    /**
     * @var DBALConnectionUtility
     */
    protected $utility;

    protected CommandBus $commandBus;

    /**
     * DBALEventStore constructor.
     *
     * @param Connection $connection
     * @param LoggerInterface $logger
     * @param CommandBus $commandBus
     */
    public function __construct(
        protected Connection $connection,
        protected LoggerInterface $logger,
        CommandBus $commandBus
    ) {
        $this->payloadSerializer = new PayloadSerializer();
        $this->commandBus = $commandBus;
        $this->utility = new DbalConnectionUtility($this->connection);
    }

    /**
     * @throws EventStoreException
     * @throws DBALException
     * @throws JsonException
     */
    #[\Override]
    public function saveAggregate(AggregateRootInterface $aggregateRoot)
    {
        $aggregateId = $aggregateRoot->getAggregateId();
        $events = $aggregateRoot->popUncomittedEvents();
        $aggregateType = $aggregateRoot::class;

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
                    'timestamp' => $this->dateTimeToTimestamp($aggregateRoot->getCreatedAt())
                ]
            );
        }

        foreach ($events as $event) {
            $eventType = $event::class;
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
                    /**
                     * To avoid collisions, each event has it's own timestamp in milliseconds
                     */
                    'timestamp' => $this->dateTimeToTimestamp($event->recordedAt())
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
            $this->commandBus->dispatch($event);
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

    /**
     * Watch out: timestamp is in MILLISECONDS
     * @param DateTimeInterface $dateTime
     * @return int
     */
    protected function dateTimeToTimestamp(DateTimeInterface $dateTime): int
    {
        return (int) ($dateTime->getTimestamp() . $dateTime->format('v'));
    }

    #[\Override]
    public function getAggregateMetadata(string $aggregateId): AggregateMetadata
    {
        // TODO: Implement getAggregateMetadata() method.
    }

    #[\Override]
    public function saveAggregateMetadata(AggregateMetadata $metadata): void
    {
        // TODO: Implement saveAggregateMetadata() method.
    }

    #[\Override]
    public function getEventsByAggregateId(string $aggregateId): array
    {
        // TODO: Implement getEventsByAggregateId() method.
    }
}