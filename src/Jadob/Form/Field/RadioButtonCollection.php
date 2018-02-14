<?php

namespace Jadob\Form\Field;

/**
 * Description of RadioButtonCollection
 * @deprecated
 * @author pizzaminded <miki@appvende.net>
 */
class RadioButtonCollection extends InputCollection {
    
    const ORIENTATION_HORIZONTAL = 'horizontal';
    const ORIENTATION_VERTICAL = 'vertical';
    
    private $orientation;
    
    private $values;
    
    public function getOrientation() {
        return $this->orientation;
    }

    public function setOrientation($orientation) {
        $this->orientation = $orientation;
        return $this;
    }
        
    public function addOption($value, $label, $checked) {
        $radioButton = new RadioButton();
        $radioButton->setChecked($checked)
                ->setName($this->getName())
                ->setLabel($label)
                ->setValue($value);
        
        $this->add($radioButton);
    }
}
