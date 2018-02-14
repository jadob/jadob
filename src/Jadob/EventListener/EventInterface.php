<?php

namespace Jadob\EventListener;

use Jadob\EventListener\Event\AfterControllerEvent;
use Jadob\EventListener\Event\AfterRouterEvent;
use Jadob\Router\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface EventInterface
 * @package Jadob\EventListener
 */
interface EventInterface
{
    /**
     * @return mixed
     */
    public function onBeforeRouterAction();

    /**
     * @param AfterRouterEvent $route
     * @return mixed
     */
    public function onAfterRouterAction(AfterRouterEvent $route);

    /**
     * @return mixed
     */
    public function onBeforeControllerAction();

    /**
     * @param AfterControllerEvent $response
     * @return mixed
     */
    public function onAfterControllerAction(AfterControllerEvent $response);

    /**
     * @return mixed
     */
    public function isEventStoppingPropagation();

}