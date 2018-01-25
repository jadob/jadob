<?php

namespace Slice\Form\Validator;

/**
 * Class MinLengthValidator
 * @package Slice\Form\Validator
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class MinLengthValidator implements  FormValidatorInterface
{

    /**
     * @var string
     */
    const MESSAGE = 'form.validator.too-short';

    protected $minLength;

    /**
     * UniqueValidator constructor.
     * @param string $table
     * @param string $field
     */
    public function __construct($minLength)
    {
        $this->minLength = $minLength;
    }


    /**
     * @param string $value
     * @return bool
     */
    public function isValid($value)
    {
       return strlen($value) >= $this->minLength;
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