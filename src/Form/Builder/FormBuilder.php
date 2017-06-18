<?php
namespace Slice\Form\Builder;

use Slice\Form\Form;
use Slice\Form\FormGroupInterface;
use Slice\Form\Field\FormFieldInterface;

class FormBuilder
{
    protected $form;

    public function __construct()
    {
        $this->form = new Form();
    }

    public function addField(FormFieldInterface $field): FormBuilder
    {
        return $this;
    }

    public function addGroup(FormGroupInterface $group): FormBuilder
    {
        return $this;
    }

    public function validate()
    {

    }

    /**
     * @return Form
     */
    public function getForm(): Form
    {
        return $this->form;
    }

}