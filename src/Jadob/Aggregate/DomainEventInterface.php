<?php
declare(strict_types=1);


namespace Jadob\Aggregate;

interface DomainEventInterface
{

    /**
     * Used for reconstruct event from EventStore.
     *
     * @param array $payload unserialized array which has been received earlier from toArray() method
     */
    public static function recreate(array $payload, string $eventId, string $aggregateId, int $version, \DateTimeInterface $recordedAt): self;

    /**
     * Used for event serialization
     * Return value from this method is passed through PayloadSerializer and sent to EventStore.
     */
    public function toArray(): array;

    public function addAttribute(string $name, string $value): void;

    /**
     * @return string[]
     * @psalm-return array<string,string>
     */
    public function getAttributes(): array;

    public function getEventId(): string;

    /**
     * @param int $number
     */
    public function assignEventNumber(int $number): void;

    public function assignAggregateId(string $aggregateId): void;
}
