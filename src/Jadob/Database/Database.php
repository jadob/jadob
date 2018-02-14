<?php

namespace Jadob\Database;

use Doctrine\DBAL\Connection;
use Jadob\Database\Model\AbstractModel;

/**
 * Class Database
 * @package Jadob\Database
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Database
{
    /**
     * @var Connection
     */
    private $dbal;

    /**
     * Instantiated models pool
     * @var AbstractModel[]
     */
    protected $pool;

    /**
     * @var array
     */
    private $config;

    /**
     * AbstractModel constructor.
     * @param Connection $dbal
     */
    public function __construct(Connection $dbal, $config)
    {
        $this->dbal = $dbal;
        $this->config = $config;
    }

    /**
     * @return Connection
     */
    public function getDbal()
    {
        return $this->dbal;
    }

    /**
     * @param Connection $dbal
     */
    public function setDbal(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    /**
     * @param string $modelName
     * @return AbstractModel
     * @throws \Exception
     */
    public function getModel($modelName)
    {
        if (!isset($this->config['models'][$modelName])) {
            throw new \Exception('model ' . $modelName . 'does not exists.');
        }

        if (!isset($this->pool[$modelName])) {
            $modelClass = $this->config['models'][$modelName];
            $this->pool[$modelName] = new $modelClass($this->getDbal());
        }

        return $this->pool[$modelName];
    }

    /**
     * @param string $tableName
     * @param array $values
     * @TODO validate table name
     * @throws \Doctrine\DBAL\DBALException
     */
    public function bulkInsert($tableName, $values)
    {
        $parameters = [];
        $sql = 'INSERT INTO __TABLE__ (__FIELDS__) VALUES __VALUES__';

        $fields = array_keys(reset($values));
        $valuesString = [];
        $fieldsImploded = implode(',', $fields);

        foreach ($values as $key => $params) {
            $row = [];
            foreach ($fields as $fieldValue) {
                $parameter = $fieldValue . '_' . $key;
                $parameters[$parameter] = $params[$fieldValue];
                $row[] = ':' . $parameter;
            }

            $valuesString[] = '(' . implode(',', $row) . ') ';
        }

        $sql = str_replace(
            [
                '__TABLE__',
                '__FIELDS__',
                '__VALUES__'
            ],
            [
                $tableName,
                $fieldsImploded,
                implode(',', $valuesString)
            ]
            , $sql);

        $statement = $this->dbal->prepare($sql);
        $statement->execute($parameters);

    }


}