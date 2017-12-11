<?php


namespace Slice\Form;


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

    /**
     * @deprecated
     */
    public function create()
    {
        $object = new Form($this->name);

        //TODO 
    }

}
