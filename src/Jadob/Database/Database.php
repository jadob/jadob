<?php

namespace Jadob\Database;

use Doctrine\DBAL\Connection;
use Jadob\Database\Model\AbstractModel;
use Jadob\Stdlib\StaticClassUtils;

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
     * @param string $modelClass FQCN or model name, passed in config
     * @return AbstractModel
     * @throws \Exception
     */
    public function getModel($modelClass)
    {

        if (isset($this->config['models'][$modelClass])) {
            $modelClass = $this->config['models'][$modelClass];
        }

        if (!StaticClassUtils::classExtends($modelClass, AbstractModel::class) /**&& !isset($this->config['models'][$modelClass]) **/) {
            throw new \Exception('Class "' . $modelClass . '" does not exists or it cannot be used as a Model.');
        }

        if (!isset($this->pool[$modelClass])) {
            $this->pool[$modelClass] = new $modelClass($this->getDbal());
        }

        return $this->pool[$modelClass];
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