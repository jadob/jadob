<?php
declare(strict_types=1);


namespace Jadob\Aggregate;

use Jadob\EventSourcing\EventStore\EventStoreInterface;
use Jadob\EventSourcing\EventStore\PayloadSerializer;

class RepositoryFactory
{
    public function __construct(private readonly EventStoreInterface $eventStore, private readonly PayloadSerializer $serializer)
    {
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