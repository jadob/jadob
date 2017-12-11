<?php

namespace Slice\Form\Field;

use Exception;
/**
 * Description of SubmitButton
 *
 * @author pizzaminded <miki@appvende.net>
 */
class SubmitButton extends AbstractButton {

    /**
     * We need to override this method
     * @return string
     */
    public function getType() {
        return self::TYPE_SUBMIT;
    }
    
     public function setType() {
       throw new Exception('You cannot set type in SubmitButton.');
    }

}
