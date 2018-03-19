<?php

namespace Jadob\Form\Field;

use Jadob\Form\Validator\FormValidatorInterface;

/**
 * Class AbstractInput
 * @package Jadob\Form\Field
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
abstract class AbstractInput implements FormFieldInterface
{

    /**
     * Input "name" parameter.
     * @var string
     */
    protected $name;

    /**
     * Field label.
     * @var string
     */
    protected $label;

    /**
     * String shown if no value given.
     * @var string
     */
    protected $placeholder;

    /**
     * Input "value" parameter.
     * @var string
     */
    protected $value;

    /**
     * Additional classes passed to input.
     * @var string
     */
    protected $class;

    /**
     * Input "required" parameter.
     * @var boolean
     */
    protected $required;
    protected $checked;
    protected $errors = [];

    /**
     * @var FormValidatorInterface[]
     */
    protected $validators = [];

    protected $firstValue;

    /**
     * @return mixed
     */
    public function getFirstValue()
    {
        return $this->firstValue;
    }

    /**
     * @param mixed $firstValue
     * @return AbstractInput
     */
    public function setFirstValue($firstValue)
    {
        $this->firstValue = $firstValue;
        return $this;
    }



    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        if($this->value !== null) {
            return $this->value;
        }
        return $this->firstValue;
    }

    public function getRequired()
    {
        return $this->required;
    }

    public function getChecked()
    {
        return $this->checked;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }

    public function setChecked($checked)
    {
        $this->checked = $checked;
        return $this;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }

    public function getValidators()
    {
        return $this->validators;
    }

    public function setValidators($validators)
    {
        $this->validators = $validators;
        return $this;
    }

    public function addError($error)
    {
        $this->errors[] = $error;
        return $this;
    }

    public function isValid()
    {
        return count($this->errors) === 0;
    }

    /**
     * @param $data
     * @throws \Exception
     */
    abstract public static function fromArray($data);

}
