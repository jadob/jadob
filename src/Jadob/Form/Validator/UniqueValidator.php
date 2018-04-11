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
    protected $message = 'form.validator.non-unique';

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
     * @param null $message
     */
    public function __construct($table, $field, $message = null)
    {
        $this->table = $table;
        $this->field = $field;

        if($message !== null) {
            $this->message = $message;
        }
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
            $this->message
        ];
    }
}