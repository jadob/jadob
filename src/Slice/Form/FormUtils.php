<?php

namespace Slice\Form;

use Slice\Form\Field\AbstractButton;
use Slice\Form\Field\FormFieldInterface;
use Slice\Form\Field\InputCollection;

/**
 * Description of FormUtils
 * @author pizzaminded <miki@appvende.net>
 */
class FormUtils {
  
    /**
     * Detect $input is InputColletion.
     * @param \Slice\Form\Field\FormFieldInterface $input
     * @return bool
     */
    public static function isInputCollection(FormFieldInterface $input) {
        return is_subclass_of($input, InputCollection::class) || get_class($input) === InputCollection::class;
    }
    
    /**
     * Detect input is *Button. 
     * @param \Slice\Form\Field\FormFieldInterface $input
     * @return bool
     */
    public static function isButton(FormFieldInterface $input) {
        return is_subclass_of($input, AbstractButton::class);
    }

    /**
     * Detect class implements Zend\Validator\ValidatorInterface.
     * @param object $object
     * @return bool
     */
    public static function isZendValidatorObject($object) {
        return in_array('Zend\Validator\ValidatorInterface', class_implements($object), true);
    }
}
