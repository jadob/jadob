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
     * @var bool
     */
    protected $blockPropagation = false;

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
    public function onBeforeControllerEvent(BeforeControllerEvent $event): void
    {
        if($this->guard->isRequestExcluded($event->getRequest())) {
            return;
        }

        $guardResponse = $this->guard->execute($event->getRequest());

        if ($guardResponse !== null) {
            $this->blockPropagation = true;
            $event->setResponse($guardResponse);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isEventStoppingPropagation()
    {
        return $this->blockPropagation;
    }
}