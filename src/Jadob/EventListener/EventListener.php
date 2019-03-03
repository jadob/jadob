<?php

namespace Jadob\EventListener;

/**
 * @TODO: this class should be called EventDispatcher to prevent misnaming and future errors
 * Class EventListener
 * @package Jadob\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class EventListener
{

    /**
     * @var array[]
     */
    protected $listeners = [];

    /**
     * @var array
     */
    protected $events = [];

    /**
     * @param EventListenerInterface $listener
     * @param int $priority
     * @return EventListener
     */
    public function addListener(EventListenerInterface $listener, $priority = 100): EventListener
    {
        $this->listeners[$priority][] = $listener;

        return $this;
    }

    /**
     * @param string $eventArgumentClassName FQCN of arguments class that will be passed to listener
     * @param string $interfaceToCheckName FQCN of interface we need to check to match event type
     * @param string $methodToCall method name, that will be executed
     * @return $this
     */
    public function addEvent($eventArgumentClassName, $interfaceToCheckName, $methodToCall)
    {
        $this->events[$eventArgumentClassName] = [
            'interface' => $interfaceToCheckName,
            'method' => $methodToCall
        ];

        return $this;
    }

    public function dispatchEvent($argumentClass): void
    {

        ksort($this->listeners);
        $eventClassName = \get_class($argumentClass);

        if (!isset($this->events[$eventClassName])) {
            throw new \RuntimeException('Event ' . $eventClassName . ' is not registered.');
        }

        $eventInfo = $this->events[$eventClassName];
        $interfaceToCheck = $eventInfo['interface'];
        $methodToCall = $eventInfo['method'];

        foreach ($this->listeners as $eventsByPriority) {
            /** @var EventListenerInterface[] $eventsByPriority */
            foreach ($eventsByPriority as $eventListener) {

                if (\in_array($interfaceToCheck, \class_implements($eventListener), true)) {
                    $eventListener->$methodToCall($argumentClass);

                    if ($eventListener->isEventStoppingPropagation()) {
                        return;
                    }
                }
            }
        }
    }
}