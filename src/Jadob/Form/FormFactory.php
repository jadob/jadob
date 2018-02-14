<?php

namespace Jadob\Form;

use Doctrine\DBAL\Connection;
use Jadob\Form\Field\ChoiceInput;
use Jadob\Form\Field\PasswordInput;
use Jadob\Form\Field\SubmitButton;
use Jadob\Form\Field\TextareaInput;
use Jadob\Form\Field\TextInput;
use Jadob\Form\Renderer\Bootstrap3HorizontalFormRenderer;
use Jadob\Form\Renderer\FormRendererInterface;

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
     * @var Connection
     */
    protected $dbal;

    /**
     * Class constructor
     * @param Connection $dbal
     */
    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;

        $this->fieldsContainer = [
            'text' => TextInput::class,
            'submit' => SubmitButton::class,
            'textarea' => TextareaInput::class,
            'choice' => ChoiceInput::class,
            'password' => PasswordInput::class
        ];

        $this->renderer = new Bootstrap3HorizontalFormRenderer();
    }

    /**
     * @param string $formType FQCN of class implementing FormTypeInterface
     * @param array $data
     * @return Form
     */
    public function createFormType($formType, $data = [], $options = [])
    {
        $builder = new FormBuilder($this, $options);

        /** @var FormTypeInterface $form */
        $form = new $formType();
        $form->buildForm($builder);

        $formName = $builder->getFormName();
        if ($formName === null) {
            $formName = $this->generateFormName($formType);
        }

        $formObject = new Form($formName, $this->renderer,'POST', $this->dbal);
        $formObject->setFields($builder->getFields());

        return $formObject->fillValuesFromArray($data, true);
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