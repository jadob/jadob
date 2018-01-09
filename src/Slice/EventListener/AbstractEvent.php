<?php

namespace Slice\EventListener;

use Slice\EventListener\Event\AfterRouterEvent;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractEvent implements EventInterface
{

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

    public function onBeforeRouterAction()
    {
        return null;
    }

    public function onAfterRouterAction(AfterRouterEvent $route)
    {
        return null;
    }

    public function onBeforeControllerAction()
    {
        return null;
    }

    public function onAfterControllerAction(Response $response)
    {
        return null;
    }

}