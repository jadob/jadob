<?php

declare(strict_types=1);

namespace Jadob\Aggregate;

use Jadob\EventStore\DateTimeFactory;
use Jadob\EventStore\EventStoreInterface;
use Jadob\EventStore\PayloadSerializer;
use JsonException;
use ReflectionException;

/**
 * Class AggregateRepository
 *
 */
class AggregateRepository
{
    /**
     * AggregateRepository constructor.
     *
     * @param EventStoreInterface $eventStore
     * @param PayloadSerializer $serializer
     * @param string $aggregateType
     */
    public function __construct(protected EventStoreInterface $eventStore, protected PayloadSerializer $serializer, protected string $aggregateType)
    {
    }

    /**
     * @param string $id
     * @return AggregateRootInterface
     * @throws AggregateException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function get(string $id): AggregateRootInterface
    {
//        //użyj snapshot store jesli istnieje i agregat wspiera snapshoty - mają zaimplementowany RecreateFromSnapshotInterface
//        //@TODO dorobić obsługę snapshotów
//        if ($this->snapshotStore !== null) {
//            // 1. Sprawdz jaka jest najnowsza wersja strumienia dla agregatu
//            // 2. Pobierz snapshot
//            // 3. Pobierz z EventStore zdarzenia które wystąpiły od momentu utworzenia snapshotu
//            // 4. Pododawaj je do Agregatu
//            // 5. Zwróc agregat
//        }

        //pobierz wszystkie zdarzenia w strumieniu
        $events = $this->eventStore->getEventsByAggregateId($id);

        if (\count($events) === 0) {
            throw new AggregateException('No events found in store for Stream ID ' . $id);
        }

        $eventsForAggregate = [];
        foreach ($events as $eventArray) {
            if ($eventArray['aid'] !== $id) {
                throw new AggregateException('Found event that does not belongs to aggregate #' . $id);
            }

            /**
             * @var DomainEventInterface $eventFqcn
             */
            $eventFqcn = $eventArray['ety'];

            $event = $eventFqcn::recreate(
                $this->serializer->deserialize($eventArray['pld']),
                $eventArray['eid'],
                $eventArray['aid'],
                $eventArray['agv'],
                DateTimeFactory::createFromMilliseconds($eventArray['tme'])
            );

            $eventsForAggregate[] = $event;
        }


        /**
         * @var AbstractAggregateRoot $aggregateFqcn
         */
        $aggregateFqcn = $this->aggregateType;

        //@TODO extract version from $events
        //@TODO commitedEvents może zawierać eventy z wielu agregatów, trzeba przerobić
        return $aggregateFqcn::recreate($id, count($events), $eventsForAggregate);
    }

    public function store(AggregateRootInterface $aggregateRoot): void
    {
        if ($aggregateRoot::class !== $this->aggregateType) {
            throw new AggregateException('Given Aggregate is not managed by this AggregateRepository.');
        }

        $this->eventStore->saveAggregate($aggregateRoot);
    }
}