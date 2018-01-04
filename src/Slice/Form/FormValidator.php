<?php

namespace Slice\Form;

use Slice\Form\Field\AbstractInput;
use Slice\Form\Field\InputCollection;

/**
 * Description of FormValidator
 * @author pizzaminded <miki@appvende.net>
 */
class FormValidator {

    /**
     * We cannot use all Validators for some reasons. Let's omit them.
     * (or throw an Exception? This one needs discussion)
     * Possible reasons:
     * 1. There is no implementation yet.
     *
     * 2. We can use e.g StringLength because it does not need any special stuff.
     * But (No)RecordExists? This one needs zend-db. Why would we have to require
     * another one database stuff when we have Doctrine DBAL?
     *
     * 3. Why we can use IsInstanceOf when we have only scalar values?
     *
     * @param object $object
     * @return bool
     */
    private function isSupportedZendValidatorObject($object) {

        return true;
    }

    /**
     * @param AbstractInput|InputCollection $input
     */
    public function validateInput($input) {

        r($input);
        //if input is collection we need to validate all stuff inside them
        if (FormUtils::isInputCollection($input)) {
            /** @var InputCollection $input */
            foreach ($input as $singleCollectionInput) {

                $this->validateInput($singleCollectionInput);
            }

            return;
        }

        /** @var $input AbstractInput */
        //do not validate buttons and inputs that have no validators defined
        if (FormUtils::isButton($input) || count($input->getValidators()) === 0) {
            return;
        }
        
        $errors = [];

        //let the show begin
        foreach ($input->getValidators() as $validator) {

            if (FormUtils::isZendValidatorObject($validator) && !$validator->isValid($input->getValue())) {
                $errors = array_merge($errors, $validator->getMessages());
            }



           //if(FormUtils::isSliceValidatorObject($validator))
        }

        $input->setErrors($errors);
    }

}
