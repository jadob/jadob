<?php

namespace Jadob\EventListener\Event\Type;

use Jadob\EventListener\Event\AfterControllerEvent;

/**
 * Interface AfterControllerListenerInterface
 * @package Jadob\EventListener\Event\Type
 */
interface AfterControllerListenerInterface
{
    /**
     * @param AfterControllerEvent $response
     * @return mixed
     */
    public function onAfterControllerAction(AfterControllerEvent $response);

}