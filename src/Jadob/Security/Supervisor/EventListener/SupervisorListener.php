<?php

namespace Jadob\Security\Supervisor\EventListener;

use Jadob\Core\Event\BeforeControllerEvent;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class SupervisorListener implements ListenerProviderInterface
{

    /**
     * @param object $event
     *   An event for which to return the relevant listeners.
     * @return iterable[callable]
     *   An iterable (array, iterator, or generator) of callables.  Each
     *   callable MUST be type-compatible with $event.
     */
    public function getListenersForEvent(object $event): iterable
    {
        if ($event instanceof BeforeControllerEvent) {
            return [
                [$this, 'onBeforeRequest']
            ];
        }

        return [];
    }

    public function onBeforeRequest(BeforeControllerEvent $event): BeforeControllerEvent
    {

    }

}