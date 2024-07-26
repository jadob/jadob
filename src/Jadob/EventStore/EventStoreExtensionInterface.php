<?php
declare(strict_types=1);


namespace Jadob\EventStore;

use Jadob\Aggregate\AggregateRootInterface;
use Jadob\Aggregate\DomainEventInterface;

/**
 * Extend your event store features by adding your own.
 * @author pizzaminded <miki@calorietool.com>
 * @license proprietary
 */
interface EventStoreExtensionInterface
{

    /**
     * @param AggregateRootInterface $aggregate
     * @param AggregateMetadata $metadata
     */
    public function onAggregateCreate(AggregateRootInterface $aggregate, AggregateMetadata $metadata): void;

    /**
     * You can eg. append some attributes to event here.
     * Aggregate as this time should be treated as read only.
     * @param DomainEventInterface $event
     * @param string $payload
     * @param AggregateRootInterface $aggregate
     */
    public function onEventAppend(DomainEventInterface $event, string $payload, AggregateRootInterface $aggregate): void;
}