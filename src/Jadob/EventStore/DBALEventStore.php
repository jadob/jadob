<?php

declare(strict_types=1);

namespace Jadob\EventStore;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Jadob\EventSourcing\AbstractDomainEvent;
use Jadob\EventSourcing\Aggregate\AbstractAggregateRoot;
use PDO;
use Psr\Log\LoggerInterface;
use function get_class;
use function time;

/**
 * @TODO this one should be EventStorage related, and EventStore should be separated
 * Class DBALEventStore
 * @package Jadob\EventStore
 */
class DBALEventStore implements EventStoreInterface
{
    /**
     * Wszystkie Eventy trzymane są w jednej tabeli
     * @var int
     */
    public const STRATEGY_ALL_IN_ONE = 1;

    /**
     * Każdy strumień zdarzeń ma swoją osobną tabelę
     * @var int
     */
    public const STRATEGY_ONE_PER_STREAM = 2;

    /**
     * Tworzy osobne tabele dla każdego typu agregatu
     * eg. dla klasy KOT bedzie osobna tabela, dla klasy PIES osobna itp.
     * @var int
     */
    public const STRATEGY_ONE_PER_TYPE = 3;

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
     * DBALEventStore constructor.
     * @param Connection $connection
     * @param LoggerInterface $logger
     * @param ProjectionManager|null $projectionManager
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
    }

    protected function createSchema(Schema $schema): void
    {
        $table = $schema->createTable('event_store');
        $table->addColumn('id', Type::INTEGER, [
            'autoincrement' => true
        ]);
    }

    public function saveAggregateRoot(AbstractAggregateRoot $aggregateRoot)
    {
        $aggregateId = $aggregateRoot->getAggregateId();
        $events = $aggregateRoot->popUncomittedEvents();
        $aggregateType = get_class($aggregateRoot);
        $timestamp = time();


        $aggregateExists = $this->hasAggregateMetadata($aggregateId);
        $this->connection->beginTransaction();

        if (!$aggregateExists) {
            $this->connection->insert('aggregates', [
                'aggregate_type' => $aggregateType,
                'aggregate_id' => $aggregateId,
                'created_timestamp' => $timestamp
            ]);
        }

        foreach ($events as $event) {
            $eventType = get_class($event);
            $eventVersion = $event->getAggregateVersion();
            $payload = $this->payloadSerializer->serialize($event->toArray());

            //TODO: LOCK TABLES na czas insertu?
            //TODO: Timestamp
            //TODO: zdarzenia do jednej tabeli, informacje o agregatach do drugiej, snapshoty do trzeciej
            //@TODO Bulk inserts? ID eventu nie jest nam tutaj do szczescia potrzebne
            $this->connection->insert('aggregate_events', [
                'aggregate_id' => $aggregateId,
                'event_type' => $eventType,
                'aggregate_version' => $eventVersion,
                'payload' => $payload
            ]);
        }
        $this->connection->commit();

        foreach ($events as $event) {
            //TODO wywalic projection manager, wklejac drugi event dispatcher poniewaz dla obu logika bedzie taka sama
            $this->projectionManager->emit($event);
            $this->eventDispatcher->emit($event);
        }
        //emit event to other dispatchers

    }

    public function hasAggregateMetadata(string $aggregateId): bool
    {
        $qb = $this->connection->createQueryBuilder()
            ->select('*')
            ->from('aggregates')
            ->where('aggregate_id = :uuid')
            ->setParameter('uuid', $aggregateId);

        $result = $qb->execute()->fetchAll(PDO::FETCH_ASSOC);

        return \count($result) !== 0;
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
            ->from('aggregate_events')
            ->where('aggregate_id = :uuid')
            ->orderBy('aggregate_version')
            ->setParameter('uuid', $streamName);

        return $qb->execute()->fetchAll(PDO::FETCH_ASSOC);
    }
}