<?php

namespace Slice\Form\Validator;


interface FormValidatorInterface
{

    public function isValid($value);

    public function getMessages();

}