<?php

namespace Jadob\Stdlib;

/**
 * methods that can be used while determining environment
 * @package Jadob\Stdlib
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class StaticEnvironmentUtils
{

    /**
     * @return bool
     */
    public static function isCli()
    {
        return (PHP_SAPI === 'cli' || \defined('STDIN'));
    }
}