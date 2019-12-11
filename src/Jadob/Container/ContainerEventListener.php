<?php

declare(strict_types=1);

namespace Jadob\Container;

class ContainerEventListener
{
    public static $events = [];

    public function emit(object $event)
    {
        self::$events[] = $event;
    }
}