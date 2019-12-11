<?php

declare(strict_types=1);

namespace Jadob\EventSourcing\Aggregate;
use Jadob\EventSourcing\AbstractDomainEvent;

/**
 * @author pizzaminded <miki@perkuma.com>
 */
abstract class AbstractAggregateRoot
{
    /**
     * //todo maybe private?
     * #TODO rename to aggregateVersion
     *
     * @var int
     */
    protected $_version = 0;

    /**
     * @var AbstractDomainEvent[]
     */
    protected $recordedEvents = [];

    /**
     * //todo maybe private?
     *
     * @var string
     */
    protected $aggregateId;

    /**
     * @param  string $aggregateId
     * @param  int    $version
     * @param  array  $events
     * @return AbstractAggregateRoot
     * @throws \ReflectionException
     */
    public static function recreate(string $aggregateId, int $version, array $events): AbstractAggregateRoot
    {

        $reflection = new \ReflectionClass(\get_called_class());
        /**
 * @var AbstractAggregateRoot $self 
*/
        $self = $reflection->newInstanceWithoutConstructor();
        $self->aggregateId = $aggregateId;
        $self->_version = $version;

        foreach ($events as $event) {
            /**
 * @var AbstractDomainEvent $event 
*/
            $self->apply($event);
        }

        return $self;
    }

    abstract protected function apply(object $event): void;

    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    /**
     * @return AbstractDomainEvent[]
     */
    public function popUncomittedEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }

    final protected function recordThat(object $event): void
    {
        $this->_version++; //increment aggregate version
        $this->recordedEvents[$this->_version] = $event; //add event to recorded events

        if ($event instanceof AbstractDomainEvent) {
            $event->setAggregateId($this->getAggregateId());
            $event->setAggregateVersion($this->_version);
        }

        $this->apply($event); //send to apply() so user can handle the state change
    }

}