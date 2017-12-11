<?php

namespace Slice\Database;


use Doctrine\DBAL\Driver\Connection;
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
        if(!isset($this->config['models'][$modelName])) {
            throw new \Exception('model '.$modelName. 'does not exists.');
        }

        $modelClass = $this->config['models'][$modelName];

        return new $modelClass($this->getDbal());
    }

}