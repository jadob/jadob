<?php

namespace Jadob\Security\Auth\EventListener;

use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;

/**
 * Class UserRefreshListener
 * @package Jadob\Security\Auth\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class UserRefreshListener implements BeforeControllerEventListenerInterface
{

    /**
     * @param BeforeControllerEvent $event
     * @return void
     */
    public function onBeforeControllerInterface(BeforeControllerEvent $event): void
    {
        // TODO: Implement onBeforeControllerInterface() method.
    }

    /**
     * @return bool
     */
    public function isEventStoppingPropagation()
    {
//        return
    }
}