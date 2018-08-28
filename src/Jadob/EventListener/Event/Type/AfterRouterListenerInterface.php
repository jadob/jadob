<?php

namespace Jadob\EventListener\Event\Type;

use Jadob\EventListener\Event\AfterRouterEvent;
use Jadob\EventListener\EventInterface;

/**
 * Interface AfterRouterListenerInterface
 * @package Jadob\EventListener\Event\Type
 */
interface AfterRouterListenerInterface extends EventInterface
{
    /**
     * @param AfterRouterEvent $route
     * @return mixed
     */
    public function onAfterRouterAction(AfterRouterEvent $route);

}