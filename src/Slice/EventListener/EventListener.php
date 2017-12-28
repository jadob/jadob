<?php

namespace Slice\EventListener;

use Slice\Router\Route;
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


    const EVENT_AFTER_CONTROLLER = 'event.after.controller';

    /**
     * All events container.
     * @var array
     */
    protected $events;

    protected $request;

    protected $response;

    public function __construct()
    {

    }

    public function addListener(EventListener $event)
    {

    }

    public function register($eventName, EventInterface $event, $priority = 0)
    {
        $this->events[$eventName][$priority][] = $event;

        return $this;
    }

    public function dispatchAfterRouterAction(Route $route)
    {

    }

    protected function dispatch($eventName, $parameter = null)
    {

    }


    /**
     * TODO: sort stuff by priority
     * In future, this function will be an alias for $this->dispatch(self::EVENT_AFTER_CONTROLLER,...)
     * @param Response $response
     * @return Response
     */
    public function dispatchAfterControllerAction(Response $response)
    {

        $eventsList = $this->events[self::EVENT_AFTER_CONTROLLER];
        foreach ($eventsList as $eventsByPriority) {
            foreach ($eventsByPriority as $event) {
                /** @var EventInterface $event */

                $response = $event->onAfterControllerAction($response);

                if ($event->isEventStoppingPropagation()) {
                    return $response;
                }
            }
        }

        return $response;
    }

    public function dispatchEvent($eventName)
    {


    }
}