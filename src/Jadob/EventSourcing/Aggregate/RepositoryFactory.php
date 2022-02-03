<?php
declare(strict_types=1);


namespace Jadob\EventSourcing\Aggregate;

use Jadob\EventSourcing\EventStore\EventStoreInterface;
use Jadob\EventSourcing\EventStore\PayloadSerializer;

class RepositoryFactory
{
    private EventStoreInterface $eventStore;
    private PayloadSerializer $serializer;

    public function __construct(
        EventStoreInterface $eventStore,
        PayloadSerializer $serializer
    ) {
        $this->eventStore = $eventStore;
        $this->serializer = $serializer;
    }

    /**
     * @param string $aggregateType Aggregate Root FQCN
     * @return AggregateRepository
     */
    public function create(string $aggregateType): AggregateRepository
    {
        return new AggregateRepository(
            $this->eventStore,
            $this->serializer,
            $aggregateType
        );
    }
}