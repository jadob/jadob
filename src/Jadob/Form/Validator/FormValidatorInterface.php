<?php

namespace Jadob\Form\Validator;

/**
 * Interface FormValidatorInterface
 * @package Jadob\Form\Validator
 */
interface FormValidatorInterface
{

    /**
     * @param $value
     * @return bool
     */
    public function isValid($value);

    /**
     * @return array
     */
    public function getMessages();

}