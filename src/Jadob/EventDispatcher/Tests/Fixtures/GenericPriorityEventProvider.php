<?php
declare(strict_types=1);

namespace Jadob\EventDispatcher\Tests\Fixtures;


use Jadob\EventDispatcher\ListenerProviderPriorityInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

class GenericPriorityEventProvider implements ListenerProviderInterface, ListenerProviderPriorityInterface
{

    protected int $priority;

    public function __construct(int $priority)
    {
        $this->priority = $priority;
    }


    public function stopEvent(GenericStoppableEvent $event)
    {
        $event->setStopped(true);
        $event->setContent('priority');
    }

    public function getListenersForEvent(object $event): iterable
    {
        if ($event instanceof GenericStoppableEvent) {
            return [
                [$this, 'stopEvent']
            ];
        }

        return [];
    }

    public function getListenerPriorityForEvent(object $event): int
    {
        if ($event instanceof GenericStoppableEvent) {
            return $this->priority;
        }
    }
}