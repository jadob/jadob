<?php

declare(strict_types=1);

namespace Jadob\EventSourcing\Aggregate;

use Jadob\EventSourcing\AbstractDomainEvent;
use Jadob\EventStore\EventStoreInterface;
use RuntimeException;
use function get_class;
use function json_decode;

/**
 * Class AggregateRepository
 * @package Jadob\EventSourcing\Aggregate
 */
class AggregateRepository
{
    /**
     * @var EventStoreInterface
     */
    protected $eventStore;

    /**
     * @var string
     */
    protected $aggregateType;

    protected $snapshotStore;

    /**
     * @var AbstractAggregateRoot[]
     */
    protected $commitedEvents = [];

    /**
     * AggregateRepository constructor.
     * @param EventStoreInterface $eventStore
     * @param string $aggregateType
     */
    public function __construct(EventStoreInterface $eventStore, string $aggregateType)
    {
        $this->eventStore = $eventStore;
        $this->aggregateType = $aggregateType;
    }

    public function get(string $id): AbstractAggregateRoot
    {
        //użyj snapshot store jesli istnieje i agregat wspiera snapshoty - mają zaimplementowany RecreateFromSnapshotInterface
        //@TODO dorobić obsługę snapshotów
        if ($this->snapshotStore !== null) {
            // 1. Sprawdz jaka jest najnowsza wersja strumienia dla agregatu
            // 2. Pobierz snapshot
            // 3. Pobierz z EventStore zdarzenia które wystąpiły od momentu utworzenia snapshotu
            // 4. Pododawaj je do Agregatu
            // 5. Zwróc agregat
        }

        //pobierz wszystkie zdarzenia w strumieniu
        $events = $this->eventStore->getStream($id);

        if(\count($events) === 0) {
            throw new AggregateException('No events found in store for Stream ID '.$id);
        }

        //Pooznaczaj wszystkie pobrane zdarzenia jako zacommitowane
        foreach ($events as $eventArray) {
            //recreate event
            /** @var AbstractDomainEvent $eventFqcn */
            $eventFqcn = $eventArray['event_type'];

            $event = $eventFqcn::fromArray(json_decode($eventArray['payload'], true, 512, JSON_THROW_ON_ERROR));
            $event->setAggregateVersion((int)$eventArray['aggregate_version']);
            $event->setAggregateId($eventArray['aggregate_id']);

            //Zablokuj możliwość oddtwarzania agregatu
            if ($event->getAggregateId() !== $id) {
                throw new RuntimeException('Found event that does not belongs to aggregate #' . $id);
            }

            //@TODO w jaki sposób szybciej/efektywniej trzymać informacje o zarządanych zdarzeniach?
            //1. Tablica obiektów?
            //2. Tablica spl_object_hashy obiektów?
            //3. SplObjectStorage?
            //4. Może jakaś inna struktura danych?
            $this->commitedEvents[] = $event;
        }

        //Odtwórz agregat
        /** @var AbstractAggregateRoot $aggregateFqcn */
        $aggregateFqcn = $this->aggregateType;

        //@TODO extract version from $events
        //@TODO commitedEvents może zawierać eventy z wielu agregatów, trzeba przerobić
        return $aggregateFqcn::recreate($id, count($events), $this->commitedEvents);
    }

    public function store(AbstractAggregateRoot $aggregateRoot): void
    {
        if (get_class($aggregateRoot) !== $this->aggregateType) {
            throw new RuntimeException('Given Aggregate is not managed by this AggregateRepository. ');
        }

        $this->eventStore->saveAggregateRoot($aggregateRoot);

    }
}