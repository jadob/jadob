<?php

namespace Slice\Database\Model;

use Doctrine\DBAL\Connection;

/**
 * Class AbstractModel
 * @package Slice\Database\Model
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


}