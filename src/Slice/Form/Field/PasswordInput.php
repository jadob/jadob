<?php

namespace Slice\Form\Field;

/**
 * Class PasswordInput
 * @package Slice\Form\Field
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class PasswordInput extends AbstractInput {

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
            ->setValue($data['value'] ?? null)
            ->setValidators($data['validators'] ?? null);
    }
}
