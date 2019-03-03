<?php

namespace Jadob\Debug\Profiler\EventListener;


use Jadob\EventListener\Event\AfterControllerEvent;
use Jadob\EventListener\Event\Type\AfterControllerEventListenerInterface;

/**
 * Class ProfilerListener
 * @package Jadob\Debug\Profiler\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ProfilerListener implements AfterControllerEventListenerInterface
{

    /**
     * @param AfterControllerEvent $event
     * @return void
     */
    public function onAfterControllerEvent(AfterControllerEvent $event)
    {

    }

    /**
     * @return bool
     */
    public function isEventStoppingPropagation()
    {
        return false;
    }
}