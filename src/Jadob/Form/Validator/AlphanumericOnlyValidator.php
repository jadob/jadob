<?php

namespace Jadob\Form\Validator;

/**
 * Allows only letters and digits.
 * @package Jadob\Form\Validator
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class AlphanumericOnlyValidator implements FormValidatorInterface
{

    /**
     * @var string
     */
    protected $additionalChars;

    /**
     * AlphanumericOnlyValidator constructor.
     * @param string $additionalChars
     * @throws \Exception
     */
    public function __construct($additionalChars = null)
    {
        $this->additionalChars = $additionalChars;
    }

    /**
     * @param string $value
     * @return bool
     */
    public function isValid($value)
    {
        return preg_match('/^[A-Za-z0-9' . preg_quote($this->additionalChars,'/') . ']*$/', $value) !== 0;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return ['form.invalid.chars'];
    }
}