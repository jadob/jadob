<?php

namespace Jadob\Form\Validator;


class CheckedValidator implements FormValidatorInterface
{

    /**
     * @param $value
     * @return bool
     */
    public function isValid($value)
    {
        return $value !== null && $value !== '' && $value !== [];
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return
        [
            'Przynajmniej jedna rzecz musi być zaznaczona'
        ];
    }
}