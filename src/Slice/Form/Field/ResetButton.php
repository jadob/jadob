<?php

namespace Slice\Form\Field;

use Exception;

/**
 * Description of ResetButton
 *
 * @author pizzaminded <miki@appvende.net>
 */
class ResetButton extends AbstractButton {

    /**
     * We need to override this method
     * @return string
     */
    public function getType() {
        return self::TYPE_RESET;
    }

    /**
     * @return $this|void
     * @throws Exception
     */
    public function setType() {
       throw new Exception('You cannot set type in ResetButton.');
    }
}