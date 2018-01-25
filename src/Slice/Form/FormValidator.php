<?php

namespace Slice\Form;

use Doctrine\DBAL\Connection;
use Slice\Form\Field\AbstractInput;
use Slice\Form\Field\InputCollection;
use Slice\Form\Validator\DatabaseAwareValidatorInterface;
use Slice\Form\Validator\FormValidatorInterface;

/**
 * Description of FormValidator
 * @author pizzaminded <miki@appvende.net>
 */
class FormValidator
{

    /**
     * @var Connection
     */
    protected $dbal;

    /**
     * FormValidator constructor.
     * @param Connection $dbal
     */
    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

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
    private function isSupportedZendValidatorObject($object)
    {

        return true;
    }

    /**
     * @param AbstractInput|InputCollection $input
     */
    public function validateInput($input)
    {

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
                /** @noinspection SlowArrayOperationsInLoopInspection */

                $errors = array_merge($errors, $validator->getMessages());
            }

            /** @var FormValidatorInterface $validator */
            if (FormUtils::isSliceValidatorObject($validator)) {

                if (FormUtils::validatorNeedsDatabaseAccess($validator)) {
                    /** @var DatabaseAwareValidatorInterface $validator */
                    $validator->setDbal($this->dbal);
                }

                if (!$validator->isValid($input->getValue())) {
                    /** @noinspection SlowArrayOperationsInLoopInspection */
                    $errors = array_merge($errors, $validator->getMessages());
                }
            }
        }

        $input->setErrors($errors);
    }

}
