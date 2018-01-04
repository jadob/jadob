<?php


namespace Slice\Form;

use Slice\Form\Field\AbstractInput;


/**
 * Description of FormBuilder
 * This one probably will be deprecated soon
 * @package Slice\Form
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FormBuilder
{

    protected $name;
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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
