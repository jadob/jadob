<?php

namespace Slice\Form;

use Slice\Form\Renderer\FormRendererInterface;
use Slice\Form\Renderer\DefaultFormRenderer;

/**
 * Description of Form
 *
 * @author pizzaminded <miki@appvende.net>
 */
class Form {

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
     * @param string $name Form name
     * @param int $method Form method attribute
     */
    public function __construct($name, $method = self::METHOD_POST) {
        $this->name = $name;
        $this->method = $method;
    }

    public function generateView() {
        if ($this->renderer === null) {
            $this->renderer = new DefaultFormRenderer();
        }

        return $this->renderer->renderForm($this);
    }

    public function handle($data) {

        //check in array if any variable with form name as key exists
        if (!isset($data[$this->name])) {
            return;
        }

        /**
         * Form data is always sent as an array. 
         */
        if (!is_array($data[$this->name])) {
            return;
        }

       
        $this->isSubmitted = true;

        //  $this->validate();
    }

    public function validate() {

        //you cant validate a form when there is no form ( ͡° ͜ʖ ͡°)
        if (!$this->isSubmitted) {
            return;
        }

        $validator = new FormValidator();

        foreach ($this->fields as $field) {
            $validator->validateInput($field);
        }
    }

    private function findField($key) {

        //if there is an field and this is not an InputCollection, get them
        if (isset($this->fields[$key])) {

            if (!FormUtils::isInputCollection($this->fields[$key])) {
                return $this->fields[$key];
            } else {
                return $this->fields[$key]->findField($key);
            }
        }
    }

    public function getMethod() {
        return $this->method;
    }

    public function setMethod($method) {
        $this->method = $method;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function getRenderer() {
        return $this->renderer;
    }

    public function getFields() {
        return $this->fields;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setRenderer(FormRendererInterface $renderer) {
        $this->renderer = $renderer;
        return $this;
    }

    public function setFields($fields) {
        $this->fields = $fields;
        return $this;
    }

}
