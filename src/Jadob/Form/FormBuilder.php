<?php


namespace Jadob\Form;

use Jadob\Database\Database;
use Jadob\Form\Field\AbstractInput;

/**
 * Description of FormBuilder
 * @package Jadob\Form
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
    /**
     * @var FormFactory
     */
    protected $formFactory;
    protected $options;
    /**
     * @var Database
     */
    protected $database;


    public function __construct(FormFactory $formFactory, Database $db, $options = [])
    {

        $this->formFactory = $formFactory;
        $this->database = $db;
        $this->options = $options;
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

    public function getOption($name)
    {
        return $this->options[$name];
    }

    /**
     * @return Database
     */
    public function getDatabase()
    {
        return $this->database;
    }

}
