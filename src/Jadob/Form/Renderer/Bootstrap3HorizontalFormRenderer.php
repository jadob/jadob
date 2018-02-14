<?php

namespace Jadob\Form\Renderer;

use Jadob\Form\Field\FormFieldInterface;
use Jadob\Form\Form;
use Jadob\Form\FormUtils;

/**
 * Class Bootstrap3HorizontalFormRenderer
 * @package Jadob\Form\Renderer
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Bootstrap3HorizontalFormRenderer implements FormRendererInterface
{

    /**
     * @var array
     */
    private $customFormTemplates = [];

    /**
     * @param FormFieldInterface $input
     * @param string $formName
     * @return string
     */
    public function renderField(FormFieldInterface $input, $formName = '')
    {
        ob_start();

        if (isset($this->customFormTemplates[get_class($input)])) {
            /** @noinspection PhpIncludeInspection */
            require_once $this->customFormTemplates[get_class($input)];
            return ob_get_clean();
        }

        $objectType = $this->getInputType($input);

        require __DIR__ . '/../Resources/templates/bootstrap_3/horizontal/' . $objectType . '.php';
        return ob_get_clean();
    }


    /**
     * @param FormFieldInterface $input
     * @return null|string|string[]
     */
    private function getInputType(FormFieldInterface $input)
    {
        $explodedClassName = explode('\\', get_class($input));
        return FormUtils::decamelize(end($explodedClassName));
    }

    /**
     * @param Form $form
     * @return string
     */
    public function renderForm(Form $form)
    {
        $content = null;

        if ($form->getFields() === null) {
            throw new \RuntimeException('No fields found.');
        }

        foreach ($form->getFields() as $field) {
            $content .= $this->renderField($field, $form->getName());
        }

        ob_start();
        require __DIR__ . '/../Resources/templates/bootstrap_3/horizontal/form.php';
        return ob_get_clean();
    }

    /**
     * @param $field
     * @param $templatePath
     */
    public function setCustomFieldTemplate($field, $templatePath)
    {
        $this->customFormTemplates[$field] = $templatePath;
    }
}
