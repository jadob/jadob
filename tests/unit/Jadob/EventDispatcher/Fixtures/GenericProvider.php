<?php
declare(strict_types=1);

namespace Jadob\EventDispatcher\Fixtures;


use Jadob\EventDispatcher\Fixtures\GenericStoppableEvent;
use Psr\EventDispatcher\ListenerProviderInterface;

class GenericProvider implements ListenerProviderInterface
{

    public function stopEvent(GenericStoppableEvent $event)
    {
        $event->setStopped(true);
        $event->setContent('generic');
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


}