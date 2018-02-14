<?php

namespace Jadob\EventListener;

use Jadob\EventListener\Event\AfterControllerEvent;
use Jadob\EventListener\Event\AfterRouterEvent;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractEvent
 * @package Jadob\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
abstract class AbstractEvent implements EventInterface
{

    /**
     * @var bool
     */
    protected $stopPropagation = false;

    /**
     * @return bool
     */
    public function isStopPropagation()
    {
        return $this->stopPropagation;
    }

    /**
     * @param bool $stopPropagation
     * @return Event
     */
    public function setStopPropagation($stopPropagation)
    {
        $this->stopPropagation = $stopPropagation;
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function onBeforeRouterAction()
    {
        return null;
    }

    /**
     * @param AfterRouterEvent $route
     * @return mixed|null
     */
    public function onAfterRouterAction(AfterRouterEvent $route)
    {
        return null;
    }

    /**
     * @return mixed|null
     */
    public function onBeforeControllerAction()
    {
        return null;
    }

    /**
     * @param AfterControllerEvent $response
     * @return mixed|null
     */
    public function onAfterControllerAction(AfterControllerEvent $response)
    {
        return null;
    }

}