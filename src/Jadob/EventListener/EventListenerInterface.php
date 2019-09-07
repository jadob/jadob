<?php

namespace Jadob\EventListener;

/**
 * @deprecated
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