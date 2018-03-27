<?php

namespace Jadob\EventListener\Event\Type;

/**
 * Interface BeforeControllerListenerInterface
 * @package Jadob\EventListener\Event\Type
 */
interface BeforeControllerListenerInterface
{
    /**
     * @return mixed
     */
    public function onBeforeControllerAction();
}