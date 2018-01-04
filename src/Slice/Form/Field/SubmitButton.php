<?php

namespace Slice\Form\Field;

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
    
     public function setType($type) {
       throw new \RuntimeException('You cannot set type in SubmitButton.');
    }

    public static function fromArray($data)
    {
        return (new self())
            ->setValue($data['value'])
            ->setName($data['name'])
            ->setLabel($data['label']);
    }
}
