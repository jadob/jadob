<?php

namespace Slice\Form\Field;

/**
 * Description of RadioButton
 * 
 * @author pizzaminded <miki@appvende.net>
 */
class RadioButton extends AbstractInput {
     
    /**
     * @var bool
     */
    protected $checked;
    
    /**
     * @throws FormException
     */
    public function setPlaceholder() {
        throw new FormException('You cannot set placeholder text on radio input.');
    }
    
    /**
     * @return bool
     */
    public function isChecked() {
        return $this->checked;
    }

    /**
     * @param bool $checked
     * @return $this
     */
    public function setChecked($checked) {
        $this->checked = $checked;
        return $this;
    }
}
