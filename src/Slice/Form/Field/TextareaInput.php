<?php

namespace Slice\Form\Field;

/**
 * Class TextInput
 * @package Slice\Form\Field
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class TextareaInput extends AbstractInput {

    /**
     * @param $data
     * @return $this
     */
    public static function fromArray($data)
    {
        return (new self())
            ->setLabel($data['label'])
            ->setName($data['name'])
            ->setRequired($data['required'])
            ->setPlaceholder($data['placeholder'])
            ->setValue($data['value']);
    }
}
