<?php

namespace Jadob\Form\Field;

/**
 * Interface FormFieldInterface
 * @package Jadob\Form\Field
 * @author pizzaminded <miki@appvende.net>
 */
interface FormFieldInterface {

    /**
     * Creates form input from config passed to $data.
     * @param $data
     * @return FormFieldInterface
     */
    public static function fromArray($data);
}
