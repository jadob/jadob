<?php

namespace Jadob\EventListener;

use Jadob\EventListener\Event\AfterControllerEvent;
use Jadob\EventListener\Event\AfterRouterEvent;
use Jadob\EventListener\Event\EventParameterInterface;
use Jadob\EventListener\Event\Type\AfterRouterListenerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EventListener
 * Service name: event.listener
 * @package Jadob\EventDispatcher
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
     * @var array
     */
    protected $events;

    /**
     * Adds new listener to events stack.
     * @param EventInterface $event
     * @param int $priority
     */
    public function addListener(EventInterface $event, $priority = 100)
    {
        $this->events[$priority][] = $event;
    }

    /**
     * @deprecated
     * @param $eventName
     * @param EventInterface $event
     * @param int $priority
     * @return $this
     */
    public function register($eventName, EventInterface $event, $priority = 0)
    {
        @trigger_error('register() is deprecated and will be removed soon. Use addListener() method instead.', E_USER_DEPRECATED);

        $this->events[$eventName][$priority][] = $event;

        return $this;
    }

    /**
     * @TODO: this one needs some refactoring to make it better
     * @param $eventName
     * @param null $parameter
     * @return null
     */
    protected function dispatch($eventName, EventParameterInterface $parameter)
    {

        $responseBeforeDispatch = $parameter->getResponse();

        foreach ($this->events as $eventsByPriority) {

            foreach ($eventsByPriority as $event) {

                /** @var EventInterface $event */

                if($eventName === self::EVENT_AFTER_ROUTER && $event instanceof AfterRouterListenerInterface) {
                    /** @var AfterRouterEvent $parameter */
                    $response = $event->onAfterRouterAction($parameter);
                }

                #TODO: add rest of events here

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

    public function dispatchAfterRouterAction(AfterRouterEvent $event)
    {
        return $this->dispatch(self::EVENT_AFTER_ROUTER, $event);
    }
}