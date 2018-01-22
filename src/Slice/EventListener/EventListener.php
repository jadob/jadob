<?php

namespace Slice\EventListener;

use Slice\EventListener\Event\AfterControllerEvent;
use Slice\EventListener\Event\AfterRouterEvent;
use Slice\EventListener\Event\EventParameterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EventListener
 * Service name: event.listener
 * @package Slice\EventDispatcher
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class EventListener
{

    /**
     * @var string
     */
    const EVENT_AFTER_CONTROLLER = 'event.after.controller';

    /**
     * @var string
     */
    const EVENT_AFTER_ROUTER = 'event.after.router';

    /**
     * All events container.
     * @var EventInterface[]
     */
    protected $events;

    protected $request;

    protected $response;

    public function __construct()
    {

    }

    public function addListener(EventInterface $event)
    {
        $this->events[] = $event;
    }

    public function register($eventName, EventInterface $event, $priority = 0)
    {
        $this->events[$eventName][$priority][] = $event;

        return $this;
    }

    public function dispatchAfterRouterAction(AfterRouterEvent $event)
    {
        return $this->dispatch(self::EVENT_AFTER_ROUTER, $event);
    }

    /**
     * @TODO: this one needs some refactoring to make it better
     * @param $eventName
     * @param null $parameter
     * @return null
     */
    protected function dispatch($eventName, EventParameterInterface $parameter)
    {

        if(!isset($this->events[$eventName])) {
            return $parameter->getResponse();
        }

        $responseBeforeDispatch = $parameter->getResponse();

        /** @var array[] $eventsList */
        $eventsList = $this->events[$eventName];

        foreach ($eventsList as $eventsByPriority) {

            foreach ($eventsByPriority as $event) {
                /** @var EventInterface $event */

                if($eventName === self::EVENT_AFTER_ROUTER) {

                    $response = $event->onAfterRouterAction($parameter);
                }

                if($eventName === self::EVENT_AFTER_CONTROLLER) {
                    $response = $event->onAfterControllerAction($parameter);
                }

                if ($event->isEventStoppingPropagation() && $parameter->getResponse() !== $responseBeforeDispatch) {
                    return $response;
                }
            }
        }

    }


    /**
     * @param Response $response
     * @return Response
     */
    public function dispatchAfterControllerAction(AfterControllerEvent $event)
    {

       return $this->dispatch(self::EVENT_AFTER_CONTROLLER, $event);
    }

    public function dispatchEvent($eventName)
    {


    }
}