<?php

namespace Jadob\Core;

class StaticPerformanceTimer
{
    protected static $entries = [];

    public static function addEntry($entryName)
    {
        self::$entries[$entryName] = [
            'time' => microtime(true),
            'memory' => memory_get_usage(true)
        ];
    }

    public static function getEntries()
    {
        return self::$entries;
    }
}