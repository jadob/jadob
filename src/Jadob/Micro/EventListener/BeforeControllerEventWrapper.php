<?php

namespace Jadob\Micro\EventListener;

use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;

/**
 * Class BeforeControllerEventWrapper
 * @package Jadob\Micro\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class BeforeControllerEventWrapper implements BeforeControllerEventListenerInterface
{

    /**
     * @var \Closure
     */
    protected $callback;

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
        // TODO: Implement isEventStoppingPropagation() method.
    }
}