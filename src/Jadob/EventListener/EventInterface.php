<?php

namespace Jadob\EventListener;


/**
 * Interface EventInterface
 * @package Jadob\EventListener
 */
interface EventInterface
{

    /**
     * @return bool
     */
    public function isEventStoppingPropagation();

}