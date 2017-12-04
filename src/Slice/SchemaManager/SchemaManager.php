<?php

namespace Slice\SchemaManager;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Comparator;
use Doctrine\DBAL\Schema\Schema;
use Slice\SchemaManager\Definition\Table;


/**
 * Class SchemaManager
 * @package Slice\SchemaManager
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class SchemaManager
{

    /**
     * @var Connection
     */
    private $dbal;

    /**
     * @var array[][]
     */
    private $config;

    /**
     * SchemaManager constructor.
     * @param Connection $dbal
     * @param $config
     */
    public function __construct(Connection $dbal, $config)
    {
        $this->dbal = $dbal;
        $this->config = $config;

    }

    /**
     * Returns array of queries needed to run to keep database in sync with schema definition.
     *
     * @return array
     */
    public function prepareUpdateQueries()
    {
        $schemaObject = new Schema();

        /** @var Table[] $tables */
        $tables = [];

        //at first, get all tables definitions
        foreach ($this->config['schema']['tables'] as $tableName => $tableDefinition) {
            $tables[$tableName] = new Table($tableDefinition);
        }

        //and then, find some relationships between them


        //next, add anything to new schema
        foreach ($tables as $tableName => $tableObject) {
            $table = $schemaObject->createTable($tableName);

            $columns = $tableObject->getColumns();

            foreach ($columns as $columnName => $columnDefinition) {
                $table->addColumn($columnName, $columnDefinition['type'], $columnDefinition['params']
                );
            }


            if (count($uniqueColumns = $tableObject->getUniqueFields()) !== 0) {
                $table->addUniqueIndex($uniqueColumns);
            }

            if (($primaryKeys = $tableObject->getPrimaryKeys()) !== null) {
                $table->setPrimaryKey($primaryKeys);
            }

            if (($indexes = $tableObject->getIndexes()) !== null) {
                $table->addIndex($indexes);
            }
        }

        //and compare everything with current database schema
        $comparator = new Comparator();
        $schemaDiff = $comparator->compare($this->dbal->getSchemaManager()->createSchema(), $schemaObject);

        //return array of diffs in proper SQL dialect
        return $schemaDiff->toSql($this->dbal->getSchemaManager()->getDatabasePlatform());
    }
}