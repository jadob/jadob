<?php

namespace Slice\Form\Validator;

use Doctrine\DBAL\Connection;

interface DatabaseAwareValidatorInterface
{
    public function setDbal(Connection $dbal);

}