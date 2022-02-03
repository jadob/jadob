<?php
declare(strict_types=1);


namespace Jadob\EventSourcing\EventStore;

use Jadob\EventSourcing\Aggregate\AggregateRootInterface;
use Jadob\EventSourcing\Aggregate\DomainEventInterface;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license proprietary
 * @internal
 */
class ExtensionManager
{

    /**
     * @var EventStoreExtensionInterface[]
     */
    private array $extensions;

    /**
     * @param EventStoreExtensionInterface[] $extensions
     */
    public function __construct(array $extensions)
    {
        $this->extensions = $extensions;
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