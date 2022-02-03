<?php
declare(strict_types=1);

namespace Jadob\EventDispatcher\Exception;

use Exception;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class EventDispatcherException extends Exception
{

    /**
     * @param object $listener
     * @param object $event
     * @return static
     */
    public static function negativeListenerPriority(object $listener, object $event): self
    {
        return new self(
            sprintf(
                'Event Listener %s returned negative priority for event %s',
                get_class($listener),
                get_class($event)
            )
        );
    }
}