<?php
declare(strict_types=1);

namespace Jadob\EventDispatcher\Fixtures;

use Closure;
use Jadob\EventDispatcher\ListenerProviderPriorityInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

class GenericPriorityEventProvider implements ListenerProviderInterface, ListenerProviderPriorityInterface
{
    protected int $priority;

    public function __construct(int $priority)
    {
        $this->priority = $priority;
    }


    public function stopEvent(GenericStoppableEvent $event): void
    {
        $event->setStopped(true);
        $event->setContent('priority');
    }

    /**
     * @param object $event
     * @return iterable<Closure>
     */
    public function getListenersForEvent(object $event): iterable
    {
        if ($event instanceof GenericStoppableEvent) {
            return [
               $this->stopEvent(...),
            ];
        }

        return [];
    }

    public function getListenerPriorityForEvent(object $event): int
    {
        if ($event instanceof GenericStoppableEvent) {
            return $this->priority;
        }

        return 0;
    }
}