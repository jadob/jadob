<?php

namespace Jadob\EventListener\Event\Type;

use Jadob\EventListener\Event\AfterRouterEvent;

/**
 * Interface AfterRouterListenerInterface
 * @package Jadob\EventListener\Event\Type
 */
interface AfterRouterListenerInterface
{
    /**
     * @param AfterRouterEvent $route
     * @return mixed
     */
    public function onAfterRouterAction(AfterRouterEvent $route);

}