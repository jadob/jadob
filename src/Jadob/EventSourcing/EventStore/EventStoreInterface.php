<?php

declare(strict_types=1);

namespace Jadob\EventSourcing\EventStore;

use Jadob\EventSourcing\Aggregate\AggregateRootInterface;

/**
 * Interface EventStoreInterface
 *
 * @package Jadob\EventStore
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
     * @param string $streamName
     * @return array of event before deserialization
     */
    public function getStream(string $streamName): array;

    public function getAggregateMetadata(string $aggregateId): AggregateMetadata;

    public function saveAggregateMetadata(AggregateMetadata $metadata): void;
}