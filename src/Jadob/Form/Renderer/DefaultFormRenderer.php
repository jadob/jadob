<?php

namespace Jadob\Form\Renderer;

use Jadob\Form\Field\AbstractInput;
use Jadob\Form\Field\FormFieldInterface;
use Jadob\Form\Form;
use Jadob\Form\FormUtils;


/**
 * Description of DefaultFormRenderer
 *
 * @author pizzaminded <miki@appvende.net>
 */
class DefaultFormRenderer implements FormRendererInterface {

    public function renderField(FormFieldInterface $input, $formName = '') {
        $objectType = $this->getInputType($input);
        
        ob_start();
        require __DIR__.'/../Resources/templates/default/'.$objectType.'.php';
        $output = ob_get_clean();
        
        return $output;
    }

    
    private function getInputType(FormFieldInterface $input) {
        $explodedClassName = explode('\\', \get_class($input));
        return FormUtils::decamelize(end($explodedClassName));
    }

    public function renderForm(Form $form) {
     
        $content = null;
        
        foreach ($form->getFields() as $field) {
            $content .= $this->renderField($field, $form->getName());
        }
        
        ob_start();
        require __DIR__.'/../Resources/templates/default/form.php';
        $output = ob_get_clean();
        
        return $output;
        
    }

    public function setCustomFieldTemplate($field, $templatePath)
    {
        // TODO: Implement setCustomFieldTemplate() method.
    }
}
