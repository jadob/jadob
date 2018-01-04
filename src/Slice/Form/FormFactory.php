<?php

namespace Slice\Form;

use Slice\Form\Field\SubmitButton;
use Slice\Form\Field\TextareaInput;
use Slice\Form\Field\TextInput;
use Slice\Form\Renderer\Bootstrap3HorizontalFormRenderer;
use Slice\Form\Renderer\FormRendererInterface;

/**
 * Class responsible for creating Forms
 * Service name: form.factory
 * @author pizzaminded <miki@appvende.net>
 */
class FormFactory
{

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
     * @var array
     */
    protected $fieldsContainer = [];

    /**
     * @var FormRendererInterface
     */
    private $renderer;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->fieldsContainer = [
            'text' => TextInput::class,
            'submit' => SubmitButton::class,
            'textarea' => TextareaInput::class
        ];

        $this->renderer = new Bootstrap3HorizontalFormRenderer();
    }

    /**
     * @param string $formType FQCN of class implementing FormTypeInterface
     * @param array $data
     * @return Form
     */
    public function createFormType($formType, $data = [])
    {
        $builder = new FormBuilder($this);

        /** @var FormTypeInterface $form */
        $form = new $formType();

        $form->buildForm($builder);

        $formObject = new Form($this->generateFormName($formType), $this->renderer);
        $formObject->setFields($builder->getFields());

        return $formObject;
    }

    private function generateFormName($formType)
    {
        $name = str_replace('\\', '_', $formType);
        return strtolower(FormUtils::decamelize($name));
    }

    public function getFieldClassName($name)
    {
        return $this->fieldsContainer[trim($name)];
    }

    public function addInput($shortName, $className)
    {
        $this->fieldsContainer[$shortName] = $className;
        return $this;
    }

    /**
     * @return FormRendererInterface
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * @param FormRendererInterface $renderer
     * @return FormFactory
     */
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

}
