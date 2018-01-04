<?php


namespace Slice\Form\Field;

/**
 * Description of TextInput
 *
 * @author pizzaminded <miki@appvende.net>
 */
class TextInput extends AbstractInput {

    public static function fromArray($data)
    {
        return (new self())
            ->setLabel($data['label'])
            ->setName($data['name'])
            ->setRequired($data['required'])
            ->setPlaceholder($data['placeholder'])
            ->setValue($data['placeholder']);
    }
}
