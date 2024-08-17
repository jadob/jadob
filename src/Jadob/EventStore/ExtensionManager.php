<?php
declare(strict_types=1);


namespace Jadob\EventStore;

use Jadob\Aggregate\AggregateRootInterface;
use Jadob\Aggregate\DomainEventInterface;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license proprietary
 * @internal
 */
class ExtensionManager
{
    /**
     * @param EventStoreExtensionInterface[] $extensions
     */
    public function __construct(private readonly array $extensions)
    {
    }

    public function dispatchOnAggregateCreate(AggregateRootInterface $aggregate, AggregateMetadata $metadata)
    {
        foreach ($this->extensions as $extension) {
            $extension->onAggregateCreate($aggregate, $metadata);
        }
    }

    public function dispatchOnEventAppend(DomainEventInterface $event, string $payload, AggregateRootInterface $aggregateRoot)
    {
        foreach ($this->extensions as $extension) {
            $extension->onEventAppend($event,$payload, $aggregateRoot);
        }
    }
}