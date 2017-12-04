<?php

namespace Slice\SchemaManager;


use Slice\SchemaManager\Definition\Table;

/**
 * Class BitmaskDecoder
 * @package Slice\SchemaManager
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class BitmaskDecoder
{
    /**
     * @param int $bitmask
     * @return string
     */
    public static function getColumnType($bitmask)
    {
        if ($bitmask & Table::TYPE_INT) {
            return 'integer';
        }

        if ($bitmask & Table::TYPE_TEXT) {
            return 'text';
        }

        if ($bitmask & Table::TYPE_BOOLEAN) {
            return 'boolean';
        }

        if($bitmask & Table::TYPE_DATETIME) {
            return 'datetime';
        }

        if($bitmask & Table::TYPE_BIGINT) {
            return 'bigint';
        }

        if($bitmask & Table::TYPE_FLOAT) {
            return 'float';
        }

    }

    /**
     * @param int $bitmask
     * @return array
     */
    public static function getColumnParams($bitmask)
    {
        $params = [];

        if ($bitmask & Table::AUTO_INCREMENT) {
            $params['autoincrement'] = true;
        }

        if ($bitmask & Table::NULLABLE) {
            $params['notnull'] = false;
        }

        return $params;
    }
}