<?php

namespace Jadob\SchemaManager;

use Jadob\SchemaManager\Definition\Table;

/**
 * Class BitmaskDecoder
 * @package Jadob\SchemaManager
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class BitmaskDecoder
{
    /**
     * @param int $bitmask
     * @return string
     * @see https://www.doctrine-project.org/projects/doctrine-dbal/en/2.7/reference/types.html#mapping-matrix
     */
    public static function getColumnType($bitmask)
    {
        if ($bitmask & Table::TYPE_VARCHAR) {
            return 'string';
        }
        if ($bitmask & Table::TYPE_INT) {
            return 'integer';
        }

        if ($bitmask & Table::TYPE_TEXT) {
            return 'text';
        }

        if ($bitmask & Table::TYPE_BOOLEAN) {
            return 'boolean';
        }

        if ($bitmask & Table::TYPE_DATETIME) {
            return 'datetime';
        }

        if ($bitmask & Table::TYPE_DATE) {
            return 'date';
        }

        if ($bitmask & Table::TYPE_BIGINT) {
            return 'bigint';
        }

        if ($bitmask & Table::TYPE_FLOAT) {
            return 'float';
        }

    }

    /**
     * @param int $bitmask
     * @return array
     */
    public static function getColumnParams($data)
    {
        $comment = null;

        $bitmask = $data;

        if (\is_array($data)) {
            $bitmask = $data['field'];
            $comment = $data['comment'] ?? null;

        }

        $params = [];
        $params['comment'] = $comment;
        $params['length'] = $data['length'] ?? null;

        if ($bitmask & Table::AUTO_INCREMENT) {
            $params['autoincrement'] = true;
        }

        if ($bitmask & Table::NULLABLE) {
            $params['notnull'] = false;
        }

        return $params;
    }
}