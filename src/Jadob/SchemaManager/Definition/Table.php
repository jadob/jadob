<?php

namespace Jadob\SchemaManager\Definition;

use Jadob\SchemaManager\BitmaskDecoder;

/**
 * Decodes table definition from array.
 * @author pizzaminded <miki@appvende.net>
 */
class Table
{

    /**
     * @var int
     */
    const TYPE_INT = 1;

    /**
     * @var int
     */
    const TYPE_BIGINT = 2;

    /**
     * @var int
     */
    const TYPE_FLOAT = 4;

    /**
     * @var int
     */
    const TYPE_DOUBLE = 8;

    /**
     * @deprecated
     * @var int
     */
    const TYPE_BOOL = 16;

    /**
     * @var int
     */
    const TYPE_TEXT = 32;

    /**
     * @var int
     */
    const TYPE_VARCHAR = 64;

    /**
     * @var int
     */
    const TYPE_DATETIME = 128;

    /**
     * @var int
     */
    const TYPE_TIMESTAMP = 256;

    /**
     * @var int
     */
    const TYPE_DATE = 512;

    /**
     * @var int
     */
    const TYPE_BOOLEAN = 1024;

    /**
     * @var int
     */
    const AUTO_INCREMENT = 2048;

    /**
     * @var int
     */
    const PRIMARY_KEY = 4096;

    /**
     * Allow column to be NULL
     * @var int
     */
    const NULLABLE = 8192;

    /**
     * Adds UNIQUE index on column
     * @var int
     */
    const UNIQUE = 16384;

    /**
     * Adds INDEX on column.
     * @var int
     */
    const INDEX = 32768;


    /**
     * @var array
     */
    protected $definition;

    /**
     * @var array
     */
    protected $columns;

    /**
     * @var array
     */
    protected $primaryKeys;

    /**
     * @var array
     *
     */
    protected $indexes;

    /**
     * Table constructor.
     * @param array $definition
     */
    public function __construct($definition)
    {
        $this->definition = $definition;
    }

    /**
     * @return array|null
     */
    public function getPrimaryKeys()
    {
        foreach ($this->definition['fields'] as $fieldName => $fieldBitmask) {
            if ($fieldBitmask & Table::PRIMARY_KEY) {
                $this->primaryKeys[] = $fieldName;
            }
        }

        return $this->primaryKeys;
    }


    /**
     * @return array
     */
    public function getColumns()
    {
        $output = [];
        foreach ($this->definition['fields'] as $fieldName => $fieldData) {

            $fieldBitmask = $fieldData;

            if (is_array($fieldData)) {
                $fieldBitmask = $fieldData['field'];
            }

            $type = BitmaskDecoder::getColumnType($fieldBitmask);
            $params = BitmaskDecoder::getColumnParams($fieldData);

            $output[$fieldName] = [
                'type' => $type,
                'params' => $params
            ];
        }

        return $output;
    }

    /**
     * @return array
     */
    public function getUniqueFields()
    {
        $output = [];

        foreach ($this->definition['fields'] as $fieldName => $fieldBitmask) {
            if ($fieldBitmask & self::UNIQUE) {
                $output[] = $fieldName;
            }
        }

        return $output;
    }

    /**
     * @return array|null
     */
    public function getIndexes()
    {
        foreach ($this->definition['fields'] as $fieldName => $fieldBitmask) {
            if ($fieldBitmask & Table::INDEX) {
                $this->indexes[] = $fieldName;
            }
        }

        return $this->indexes;

    }
}