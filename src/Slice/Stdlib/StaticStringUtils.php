<?php

namespace Slice\Stdlib;

/**
 * Class StaticStringUtils
 * @package Slice\Stdlib
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class StaticStringUtils
{

    /**
     * @param $length
     * @param string $keyspace
     * @return string
     */
    public static function generateRandomString($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }

}