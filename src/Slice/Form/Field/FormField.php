<?php
namespace Slice\Form\Field;

/**
 * Class FormField
 * @package Slice\Form\Field
 */
abstract class FormField
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var bool
     */
    protected $required;

    /**
     * @var string
     */
    protected $validators;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return FormField
     */
    public function setType(string $type): FormField
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return FormField
     */
    public function setName(string $name): FormField
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return FormField
     */
    public function setValue(string $value): FormField
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param boolean $required
     * @return FormField
     */
    public function setRequired(bool $required): FormField
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return string
     */
    public function getValidators(): string
    {
        return $this->validators;
    }

    /**
     * @param string $validators
     * @return FormField
     */
    public function setValidators(string $validators): FormField
    {
        $this->validators = $validators;
        return $this;
    }

}