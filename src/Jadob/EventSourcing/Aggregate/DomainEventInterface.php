<?php


namespace Jadob\EventSourcing\Aggregate;


interface DomainEventInterface
{

    /**
     * Used for reconstruct event from EventStore
     * @param array $payload unserialized array which has been received earlier from toArray() method
     * @param string $eventId
     * @param string $aggregateId
     * @param int $version
     * @param \DateTimeInterface $recordedAt
     * @return self
     */
    public static function recreate(array $payload, string $eventId, string $aggregateId, int $version, \DateTimeInterface $recordedAt): self;

    /**
     * Used for event serialization
     * Return value from this method is passed through PayloadSerializer and sent to EventStore
     * @return array
     */
    public function toArray(): array;


    /**
     * @param string $name
     * @param string $value
     */
    public function addAttribute(string $name, string $value): void;

    /**
     * @return string[]
     * @psalm-return array<string,string>
     */
    public function getAttributes(): array;

    public function getEventId(): string;

}