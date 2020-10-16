<?php
declare(strict_types=1);

namespace Jadob\EventDispatcher;

/**
 * When your listener implements this interface, it is possible to re-order event listener dispatching.
 * By default, each event has a priority equal 100, you can set any non-negative integer to e.g. move invoking listeners
 * from given listener earlier or later.
 * Lower priority - earlier execution.
 * THIS DOES NOT AFFECTS STOPPABLE EVENTS - so there can be a situation that listeners with lower priority can halt dispatching.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface ListenerProviderPriorityInterface
{

    /**
     * @param object $event
     * @return int
     */
    public function getListenerPriorityForEvent(object $event): int;
}