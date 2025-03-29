<?php

declare(strict_types=1);

namespace Jadob\Container;

/**
 * @deprecated
 */
class ContainerEventListener
{
    public static $events = [];

    public function emit(object $event): void
    {
        self::$events[] = $event;
    }
}