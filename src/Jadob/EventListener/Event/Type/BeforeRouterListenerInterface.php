<?php

namespace Jadob\EventListener\Event\Type;

/**
 * Interface BeforeRouterAction
 * @package Jadob\EventListener\Event\Type
 */
interface BeforeRouterListenerInterface
{
    /**
     * @return mixed
     */
    public function onBeforeRouterAction();

}