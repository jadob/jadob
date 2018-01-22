<?php

namespace Slice\Form;

/**
 * @author pizzaminded <miki@appvende.net>
 */
interface FormTypeInterface {
    
    public function buildForm(FormBuilder $builder);
}
