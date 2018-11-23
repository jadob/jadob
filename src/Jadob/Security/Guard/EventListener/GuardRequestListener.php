<?php

namespace Jadob\Security\Guard\EventListener;

use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;
use Jadob\Security\Guard\Guard;

/**
 * Class GuardRequestListener
 * @package Jadob\Security\Guard\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class GuardRequestListener implements BeforeControllerEventListenerInterface
{

    /**
     * @var Guard
     */
    protected $guard;

    /**
     * GuardRequestListener constructor.
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * {@inheritdoc}
     */
    public function onBeforeControllerInterface(BeforeControllerEvent $event): void
    {
        $authenticatorRule = $this->guard->matchRule($event->getRequest());

        r($authenticatorRule);
    }

    /**
     * {@inheritdoc}
     */
    public function isEventStoppingPropagation()
    {
        // TODO: Implement isEventStoppingPropagation() method.
    }
}