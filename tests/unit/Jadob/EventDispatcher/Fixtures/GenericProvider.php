<?php
declare(strict_types=1);

namespace Jadob\EventDispatcher\Fixtures;

use Closure;

use Psr\EventDispatcher\ListenerProviderInterface;

class GenericProvider implements ListenerProviderInterface
{
    public function stopEvent(GenericStoppableEvent $event): void
    {
        $event->setStopped(true);
        $event->setContent('generic');
    }

    /**
     * @param object $event
     * @return iterable<Closure>
     */
    public function getListenersForEvent(object $event): iterable
    {
        if ($event instanceof GenericStoppableEvent) {
            return [
                $this->stopEvent(...)
            ];
        }

        return [];
    }
}