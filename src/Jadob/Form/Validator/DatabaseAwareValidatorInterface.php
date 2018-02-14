<?php

namespace Jadob\Form\Validator;

use Doctrine\DBAL\Connection;

/**
 * Interface DatabaseAwareValidatorInterface
 * @package Jadob\Form\Validator
 */
interface DatabaseAwareValidatorInterface
{
    /**
     * @param Connection $dbal
     * @return $this
     */
    public function setDbal(Connection $dbal);

}