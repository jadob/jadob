<?php

namespace Slice\Form;

/**
 * Class responsible for creating Forms
 * Service name: form.factory
 * @author pizzaminded <miki@appvende.net>
 */
class FormFactory {

    /**
     * Extensions that can be used during form creating
     * @var array
     */
    protected $extensions = [];

    /**
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Class constructor
     */
    public function __construct() {
        $this->builder = new FormBuilder();
    }

    /**
     * @param \Slice\Form\FormTypeInterface $formType
     * @param array $data 
     * @return Form Description
     */
    public function createFormType($formType, $data = []) {
        $builder = new FormBuilder();

        /** @var FormTypeInterface $form */
        $form = new $formType();
        
        $form->buildForm($builder);
                        
        $formObject = new Form($this->generateFormName($formType));
        $formObject->setFields($builder->getFields());
        
        return $formObject;
    }

    private function generateFormName($formType) {
        $name = str_replace('\\', '_', $formType);
        return strtolower(decamelize($name));
    }
    
    public function createFormFromArray($name, $form, $data = []) {
        
    }

}
