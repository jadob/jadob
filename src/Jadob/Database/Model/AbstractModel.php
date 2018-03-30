<?php

namespace Jadob\Database\Model;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Class AbstractModel
 * @package Jadob\Database\Model
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
abstract class AbstractModel
{

    /**
     * @var Connection
     */
    protected $dbal;

    /**
     * @var string
     */
    protected $tableName;

    /**
     * AbstractModel constructor.
     * @param Connection $dbal
     */
    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    /**
     * This method assumes that your primary key is called 'id' (☞ຈل͜ຈ)☞
     *
     * @param $pk
     * @return mixed
     */
    public function findByPK($pk)
    {
        $qb = $this->dbal->createQueryBuilder()
            ->select('*')
            ->from($this->getTableName(),'a')
            ->where('a.id = :id')
            ->setParameter('id', $pk)
            ->setMaxResults(1)
            ->execute();

        return $qb->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param mixed $tableName
     * @return AbstractModel
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    /**
     * @return \Doctrine\DBAL\Query\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->dbal->createQueryBuilder();
    }

    /**
     * Fetches single object from querybuilder. If nothing found, returns NULL.
     * Warning: Query Builder could not be executed before.
     * @param QueryBuilder $qb
     * @param bool $asArray
     * @return \stdClass|array|null
     */
    public function getSingleResult(QueryBuilder $qb, $asArray = false)
    {

        $result = $qb->execute();

        if($result->rowCount() === 0) {
            return null;
        }

        if($asArray) {
            return $result->fetch(\PDO::FETCH_ASSOC);
        }

        return $result->fetch(\PDO::FETCH_OBJ);

    }

    /**
     * Fetches all objects from querybuilder. If nothing found, returns NULL.
     * Warning: Query Builder could not be executed before.
     * @param QueryBuilder $qb
     * @param bool $asArray
     * @return \stdClass|array|null
     */
    public function getResults(QueryBuilder $qb, $asArray = false)
    {
        $result = $qb->execute();

        if($result->rowCount() === 0) {
            return null;
        }

        if($asArray) {
            return $result->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $result->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Shortcut for DBAL insert() method.
     * @param $data
     * @return int
     */
    public function insert($data)
    {
        $this->dbal->insert($this->tableName, $data);

        return (int) $this->dbal->lastInsertId();
    }

}