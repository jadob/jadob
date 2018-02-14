<?php

namespace Jadob\Form\Field;

/**
 * Class TextInput
 * @package Jadob\Form\Field
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class TextInput extends AbstractInput
{

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
            ->setValidators($data['validators'] ?? [])
            ->setValue($data['value'] ?? null)
            ->setClass($data['class'] ?? null);

    }
}
