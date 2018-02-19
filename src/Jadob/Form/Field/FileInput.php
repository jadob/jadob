<?php

namespace Jadob\Form\Field;

/**
 * Class FileInput
 * @package Jadob\Form\Field
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FileInput extends AbstractInput
{

    /**
     * @param $data
     * @return FileInput
     * @throws \Exception
     */
    public static function fromArray($data)
    {
        return (new self())
            ->setLabel($data['label'])
            ->setName($data['name'])
            ->setRequired($data['required'])
            ->setValidators($data['validators'] ?? [])
            ->setClass($data['class'] ?? null);
    }
}