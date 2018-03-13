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

    /**
     * @param $className
     * @param $interfaceClassName
     * @return bool
     */
    public static function classImplements($className, $interfaceClassName)
    {
        return \in_array($interfaceClassName, class_implements($className), true);
    }
}