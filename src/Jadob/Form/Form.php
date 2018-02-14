<?php

namespace Jadob\Form;

use Doctrine\DBAL\Connection;
use Jadob\Form\Field\AbstractInput;
use Jadob\Form\Renderer\Bootstrap3HorizontalFormRenderer;
use Jadob\Form\Renderer\FormRendererInterface;
use Jadob\Form\Renderer\DefaultFormRenderer;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of Form
 *
 * @author pizzaminded <miki@appvende.net>
 */
class Form
{

    /**
     * @var int
     */
    const METHOD_POST = 'POST';

    /**
     * @var int
     */
    const METHOD_GET = 'GET';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var FormRendererInterface
     */
    protected $renderer;

    /**
     * @var bool
     */
    protected $isSubmitted = false;

    /**
     * All form fields.
     * @var array
     */
    protected $fields = [];

    /**
     * Array of field names that have been submitted
     * @var array
     */
    protected $submittedFields = [];

    /**
     * @var Connection
     */
    protected $dbal;

    /**
     * @param string $name Form name
     * @param $renderer
     * @param int $method Form method attribute
     */
    public function __construct($name, $renderer, $method = self::METHOD_POST, Connection $dbal)
    {
        $this->name = $name;
        $this->renderer = $renderer;
        $this->method = $method;
        $this->dbal = $dbal;
    }

    public function generateView()
    {
        return $this->renderer->renderForm($this);
    }


    public function handle(Request $request)
    {

        $method = $request->getMethod();
        if ($method !== $this->getMethod()) {
            return;
        }

        $data = $request->query->all();
        if ($method === 'POST') {
            $data = $request->request->all();
        }

        //check in array if any variable with form name as key exists
        if (!isset($data[$this->name]) || !\is_array($data[$this->name])) {
            return;
        }

        $this->isSubmitted = true;

        $this->fillValuesFromArray($data[$this->name]);
        $this->validate();
    }

    public function fillValuesFromArray($data, $firstValues = false)
    {
        if (\count($data) === 0) {
            return $this;
        }

        foreach ($this->fields as $field) {
            /** @var AbstractInput $field */
            if ($field->getName() !== null && !FormUtils::isButton($field)) {
                if ($firstValues) {
                    $field->setFirstValue($data[$field->getName()]);
                } else {
                    $field->setValue($data[$field->getName()]);
                }
            }
        }

        return $this;
    }

    public function validate()
    {

        //you cant validate a form when there is no form submitted ( ͡° ͜ʖ ͡°)
        if (!$this->isSubmitted) {
            return;
        }

        $validator = new FormValidator($this->dbal);

        /** @var AbstractInput $field */
        foreach ($this->fields as $field) {

            if (!FormUtils::isButton($field) && $field->getFirstValue() !== $field->getValue()) {
                $validator->validateInput($field);
            }
        }
    }

    private function findField($key)
    {

        //if there is an field and this is not an InputCollection, get them
        if (isset($this->fields[$key])) {

            if (!FormUtils::isInputCollection($this->fields[$key])) {
                return $this->fields[$key];
            }
            return $this->fields[$key]->findField($key);
        }

    }

    public function getData()
    {
        $output = [];
        foreach ($this->fields as $field) {

            /** @var AbstractInput $field */
            if ($field->getName() !== null) {
                $output[$field->getName()] = $field->getValue();
            }
        }

        return $output;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRenderer()
    {
        return $this->renderer;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setRenderer(FormRendererInterface $renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function isSubmitted()
    {
        return $this->isSubmitted;
    }

    public function isValid()
    {
        foreach ($this->fields as $field) {
            /** @var AbstractInput $field */
            if (!FormUtils::isButton($field) && !$field->isValid()) {
                return false;
            }
        }

        return true;
    }
}