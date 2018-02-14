<?php

namespace Jadob\Form\Field;

/**
 * Description of AbstractButton
 *
 * @author pizzaminded <miki@appvende.net>
 */
abstract class AbstractButton implements FormFieldInterface {

    const TYPE_BUTTON = 'button';
    const TYPE_SUBMIT = 'submit';
    const TYPE_RESET = 'reset';
    
    protected $name;
    protected $label;
    protected $value;
    protected $type;

    
    public function getName() {
        return $this->name;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getValue() {
        return $this->value;
    }

    public function getType() {
        return $this->type;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

}
