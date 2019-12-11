<?php

declare(strict_types=1);

namespace Jadob\EventStore;

use Jadob\EventSourcing\AbstractDomainEvent;
use Jadob\EventSourcing\Aggregate\AbstractAggregateRoot;

/**
 * Interface EventStoreInterface
 *
 * @package Jadob\EventStore
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 */
interface EventStoreInterface
{
    /**
     * @param  AbstractAggregateRoot $aggregateRoot
     * @return void
     */
    public function saveAggregateRoot(AbstractAggregateRoot $aggregateRoot);

    /**
     * @TODO   refactor name
     * @param  string $streamName
     * @return AbstractDomainEvent[]
     */
    public function getStream(string $streamName): array;

}