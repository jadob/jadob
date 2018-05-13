<?php

namespace Jadob\Stdlib;

/**
 * Class StaticStringUtils
 * @package Jadob\Stdlib
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

    /**
     * @param string $string
     * @return bool
     */
    public static function nullOrEmpty($string)
    {
        if ($string === '') {
            return true;
        }

        return $string === null;
    }

    /**
     * Returns array with no null-or-empty values.
     * @param string $string
     * @param string $delimiter
     * @return array
     */
    public static function explode($string, $delimiter = ',')
    {
        $explodedValues = \explode($delimiter, $string);

        return array_filter($explodedValues);
    }
}