<?php

namespace Jadob\Form;

use Jadob\Form\Field\AbstractButton;
use Jadob\Form\Field\FormFieldInterface;
use Jadob\Form\Field\InputCollection;
use Jadob\Form\Validator\DatabaseAwareValidatorInterface;
use Jadob\Form\Validator\FormValidatorInterface;

/**
 * Description of FormUtils
 * @internal
 * @author pizzaminded <miki@appvende.net>
 */
class FormUtils {
  
    /**
     * Detect $input is InputColletion.
     * @param \Jadob\Form\Field\FormFieldInterface $input
     * @return bool
     */
    public static function isInputCollection(FormFieldInterface $input) {
        return \is_subclass_of($input, InputCollection::class) || \get_class($input) === InputCollection::class;
    }
    
    /**
     * Detect input is *Button. 
     * @param \Jadob\Form\Field\FormFieldInterface $input
     * @return bool
     */
    public static function isButton(FormFieldInterface $input) {
        return \is_subclass_of($input, AbstractButton::class);
    }

    /**
     * Detect class implements Zend\Validator\ValidatorInterface.
     * @param object $object
     * @return bool
     */
    public static function isZendValidatorObject($object) {
        return \in_array('Zend\Validator\ValidatorInterface', class_implements($object), true);
    }

    /**
     * @param $object
     * @return bool
     */
    public static function isJadobValidatorObject($object)
    {
        return \in_array(FormValidatorInterface::class, class_implements($object), true);
    }

    public static function validatorNeedsDatabaseAccess($object)
    {
       return \in_array(DatabaseAwareValidatorInterface::class, class_implements($object), true);
    }

    public static function camelize($word) {
        return preg_replace('/(^|_)([a-z])/e', 'strtoupper("\\2")', $word);
    }

    /**
     * @param $word
     * @return null|string|string[]
     */
    public static function decamelize($word) {
        return strtolower(ltrim(preg_replace('/[A-Z]/', '_$0', $word), '_'));
    }

}
