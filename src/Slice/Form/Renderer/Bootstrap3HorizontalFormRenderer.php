<?php

namespace Slice\Form\Renderer;


use Slice\Form\Field\FormFieldInterface;
use Slice\Form\Form;
use Slice\Form\FormUtils;

class Bootstrap3HorizontalFormRenderer implements FormRendererInterface
{

    private $customFormTemplates = [];

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


    private function getInputType(FormFieldInterface $input)
    {
        $explodedClassName = explode('\\', get_class($input));
        return FormUtils::decamelize(end($explodedClassName));
    }

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

    public function setCustomFieldTemplate($field, $templatePath)
    {
        $this->customFormTemplates[$field] = $templatePath;
    }
}
