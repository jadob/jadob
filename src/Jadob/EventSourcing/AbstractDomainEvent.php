<?php

declare(strict_types=1);

namespace Jadob\EventSourcing;

/**
 * Base class for domain events in aggregate roots.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
abstract class AbstractDomainEvent
{
    /**
     * @var int
     */
    private $aggregateVersion;

    /**
     * @var string
     */
    private $aggregateId;

    /**
     * @param string $aggregateId
     *
     * @return void
     */
    public function setAggregateId(string $aggregateId): void
    {
        $this->aggregateId = $aggregateId;
    }

    /**
     * @param int $version
     *
     * @return void
     */
    public function setAggregateVersion(int $version): void
    {
        $this->aggregateVersion = $version;
    }

    /**
     * @return string
     */
    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    /**
     * @return int
     */
    public function getAggregateVersion(): int
    {
        return $this->aggregateVersion;
    }

    /**
     * Used for event serialization
     * Return value from this method is passed through PayloadSerializer and sent to EventStore
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * Used for reconstruct event from EventStore
     * @param array $payload unserialized array which has been received earlier from toArray() method
     * @return self
     */
    abstract public static function fromArray(array $payload): self;
}