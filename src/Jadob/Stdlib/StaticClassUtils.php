<?php

namespace Jadob\Stdlib;

/**
 * Class StaticClassUtils
 * @package Jadob\Stdlib
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class StaticClassUtils
{
    /**
     * @param $className
     * @param $parentClassName
     * @return bool
     */
    public static function classExtends($className, $parentClassName)
    {
        return \in_array($parentClassName, class_parents($className), true);
    }
}