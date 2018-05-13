<?php

namespace Jadob\Form\Validator;

/**
 * Class UrlValidator
 * @package Jadob\Form\Validator
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class UrlValidator implements FormValidatorInterface
{

    /**
     * @param $value
     * @return bool
     */
    public function isValid($value)
    {
        return (bool)filter_var($value, FILTER_VALIDATE_URL);
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return ['form.invalid.url'];
    }
}