<?php

namespace Slice\Database;

use Doctrine\DBAL\Connection;
use Slice\Database\Model\AbstractModel;

/**
 * Class Database
 * @package Slice\Database
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

    public function bulkInsert($tableName, $values)
    {
//        $sql = $this->dbal->
    }


}