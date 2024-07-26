<?php

declare(strict_types=1);

namespace Jadob\EventStore;

use Jadob\Aggregate\AggregateRootInterface;

/**
 * Interface EventStoreInterface
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 */
interface EventStoreInterface
{
    /**
     * @param AggregateRootInterface $aggregateRoot
     * @return void
     */
    public function saveAggregate(AggregateRootInterface $aggregateRoot);

    /**
     * @param string $aggregateId
     * @return array of event before deserialization
     */
    public function getEventsByAggregateId(string $aggregateId): array;

    public function getAggregateMetadata(string $aggregateId): AggregateMetadata;

    public function saveAggregateMetadata(AggregateMetadata $metadata): void;
}