<?php


namespace Slice\Form;

use Slice\Form\Field\AbstractInput;

/**
 * Description of FormBuilder
 * @package Slice\Form
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FormBuilder
{

    /**
     * @var string
     */
    protected $formName;
    protected $fields;
    protected $formFactory;

    public function __construct(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormName()
    {
        return $this->formName;
    }

    /**
     * @param string $formName
     * @return FormBuilder
     */
    public function setFormName($formName)
    {
        $this->formName = $formName;
        return $this;
    }

    public function add($object)
    {
        $this->fields[$object->getName()] = $object;

        return $this;
    }

    public function addField($fieldName, $params = [])
    {
        $fieldClass = $this
            ->formFactory
            ->getFieldClassName($fieldName);

        /** @var AbstractInput $field */
        $field = $fieldClass::fromArray($params);

        $this->add($field);

        return $this;
    }

}
