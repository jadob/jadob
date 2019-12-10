<?php

declare(strict_types=1);

namespace Jadob\EventSourcing;

abstract class AbstractDomainEvent
{
    //todo maybe private?
    //int
    protected $aggregateVersion;

    //todo maybe private?
    //uuid
    protected $aggregateId;


    public function setAggregateId(string $aggregateId)
    {
        $this->aggregateId = $aggregateId;
    }

    public function setAggregateVersion(int $version)
    {
        $this->aggregateVersion = $version;
    }

    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    public function getAggregateVersion(): int
    {
        return $this->aggregateVersion;
    }

    abstract public function toArray(): array;

    abstract public static function fromArray(array $payload): self;
}