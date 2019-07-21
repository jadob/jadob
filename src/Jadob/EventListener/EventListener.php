<?php

namespace Jadob\EventListener;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

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
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * EventListener constructor.
     * @param LoggerInterface|null $logger
     */
    public function __construct(?LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

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

        $this->log('Event class ' . \get_class($argumentClass) . ' has been dispatched');
        ksort($this->listeners);
        $eventClassName = \get_class($argumentClass);

        if (!isset($this->events[$eventClassName])) {
            throw new \RuntimeException('Event ' . $eventClassName . ' is not registered.');
        }

        $eventInfo = $this->events[$eventClassName];
        $interfaceToCheck = $eventInfo['interface'];
        $methodToCall = $eventInfo['method'];

        foreach ($this->listeners as $priority => $eventsByPriority) {

            $this->log('Dispatching events for priority ' . $priority);
            /** @var EventListenerInterface[] $eventsByPriority */
            foreach ($eventsByPriority as $eventListener) {

                if (\in_array($interfaceToCheck, \class_implements($eventListener), true)) {
                    $this->log('Calling ' . \get_class($eventListener) . '#' . $methodToCall);
                    $eventListener->$methodToCall($argumentClass);

                    if ($eventListener->isEventStoppingPropagation()) {
                        $this->log('Class ' . \get_class($eventListener) . ' stopped event propagation, finishing event dispatching');
                        return;
                    }
                }
            }
        }
    }

    private function log(string $message, array $context = []): void
    {
        if ($this->logger === null) {
            return;
        }

        $this->logger->info($message, $context);
    }
}