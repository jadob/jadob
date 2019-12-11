<?php

namespace Jadob\Security\Guard\EventListener;

use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;
use Jadob\Security\Guard\Guard;
use Psr\Log\LoggerInterface;

/**
 * @deprecated
 * @author     pizzaminded <miki@appvende.net>
 * @license    MIT
 */
class GuardRequestListener //implements BeforeControllerEventListenerInterface
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
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * GuardRequestListener constructor.
     *
     * @param Guard $guard
     */
    public function __construct(Guard $guard, ?LoggerInterface $logger = null)
    {
        $this->guard = $guard;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function onBeforeControllerEvent(BeforeControllerEvent $event): void
    {
        if ($this->guard->isRequestExcluded($event->getRequest())) {
            $this->log('Current request is excluded, no guard will be used for this action.');
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

    private function log(string $message, array $context = []): void
    {
        if ($this->logger === null) {
            return;
        }

        $this->logger->info($message, $context);
    }
}