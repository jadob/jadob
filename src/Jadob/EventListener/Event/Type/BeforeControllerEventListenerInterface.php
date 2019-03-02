<?php

namespace Jadob\EventListener\Event\Type;

use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\EventListenerInterface;

/**
 * Classes implementing this one will be executed after router, before controller executing.
 * @package Jadob\EventListener\Event\Type
 * @author pizzaminded <miki@appvende.net>
 */
interface BeforeControllerEventListenerInterface extends EventListenerInterface
{
    /**
     * @param BeforeControllerEvent $event
     * @return void
     */
    public function onBeforeControllerEvent(BeforeControllerEvent $event): void;

}