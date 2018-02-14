<?php

namespace Jadob\Form\Validator;

use Doctrine\DBAL\Connection;

/**
 * Class UniqueValidator
 * @package Jadob\Form\Validator
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class UniqueValidator implements DatabaseAwareValidatorInterface, FormValidatorInterface
{

    /**
     * @var string
     */
    const MESSAGE = 'form.validator.non-unique';

    /**
     * @var string
     */
    protected $table;

    /**
     * @var string
     */
    protected $field;

    /**
     * UniqueValidator constructor.
     * @param string $table
     * @param string $field
     */
    public function __construct($table, $field)
    {
        $this->table = $table;
        $this->field = $field;
    }

    /**
     * @var Connection
     */
    protected $dbal;

    /**
     * @param Connection $dbal
     */
    public function setDbal(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function isValid($value)
    {
        $qb = $this->dbal
            ->createQueryBuilder()
            ->select('*')
            ->from($this->table)
            ->where($this->field.' = :val')
            ->setParameter('val', $value);

        return $qb->execute()->rowCount() === 0;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return [
            self::MESSAGE
        ];
    }
}