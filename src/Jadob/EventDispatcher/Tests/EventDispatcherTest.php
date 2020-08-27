<?php
declare(strict_types=1);

namespace Jadob\EventDispatcher\Tests;


use Jadob\EventDispatcher\EventDispatcher;
use Jadob\EventDispatcher\Tests\Fixtures\GenericPriorityEventProvider;
use Jadob\EventDispatcher\Tests\Fixtures\GenericProvider;
use Jadob\EventDispatcher\Tests\Fixtures\GenericStoppableEvent;
use PHPUnit\Framework\TestCase;

class EventDispatcherTest extends TestCase
{

    public function testLowestPriorityListenersWouldBeInvokedFirst()
    {
        $dispatcher = new EventDispatcher();
        $dispatcher->addListener(new GenericProvider());
        $dispatcher->addListener(new GenericPriorityEventProvider(10));

        $event = new GenericStoppableEvent(false);
        /** @var GenericStoppableEvent $processedEvent */
        $processedEvent = $dispatcher->dispatch($event);

        $this->assertEquals($processedEvent->getContent(), 'priority');

    }
}