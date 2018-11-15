<?php

namespace Jadob\EventListener;

/**
 * Interface EventInterface
 * @package Jadob\EventListener
 * @author pizzaminded <miki@appvende.net>
 */
interface EventListenerInterface
{
    /**
     * @return bool
     */
    public function isEventStoppingPropagation();
}