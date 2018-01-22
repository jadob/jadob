<?php

namespace Slice\Form;

use Slice\Form\Field\AbstractButton;
use Slice\Form\Field\FormFieldInterface;
use Slice\Form\Field\InputCollection;
use Slice\Form\Validator\FormValidatorInterface;

/**
 * Description of FormUtils
 * @internal
 * @author pizzaminded <miki@appvende.net>
 */
class FormUtils {
  
    /**
     * Detect $input is InputColletion.
     * @param \Slice\Form\Field\FormFieldInterface $input
     * @return bool
     */
    public static function isInputCollection(FormFieldInterface $input) {
        return \is_subclass_of($input, InputCollection::class) || get_class($input) === InputCollection::class;
    }
    
    /**
     * Detect input is *Button. 
     * @param \Slice\Form\Field\FormFieldInterface $input
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
    public static function isSliceValidatorObject($object)
    {
        return \in_array(FormValidatorInterface::class, class_implements($object), true);
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
