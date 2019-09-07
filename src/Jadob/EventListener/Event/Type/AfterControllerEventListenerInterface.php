<?php

namespace Jadob\EventListener\Event\Type;

use Jadob\EventListener\Event\AfterControllerEvent;
use Jadob\EventListener\EventListenerInterface;

/**
 * @deprecated
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface AfterControllerEventListenerInterface extends EventListenerInterface
{

    /**
     * @param AfterControllerEvent $event
     * @return void
     */
    public function onAfterControllerEvent(AfterControllerEvent $event);
}