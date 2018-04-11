<?php

namespace Jadob\Form\Field;

/**
 * Allows you to generate radiobuttons, checkboxes and select tags in your form.
 * @author pizzaminded <miki@appvende.net>
 */
class ChoiceInput extends AbstractInput
{

    /**
     * @var string
     */
    const ORIENTATION_HORIZONTAL = 'horizontal';
    /**
     * @var string
     */
    const ORIENTATION_VERTICAL = 'vertical';

    /**
     * Allows to select more than one option (when rendering as select)
     * Or turns options to checkboxes
     * @var bool
     */
    protected $multiple = false;

    /**
     * If true - renders options as radiobuttons/checkboxes
     * otherwise - as select
     * @var bool
     */
    protected $expanded = false;
    protected $checkedOption;
    private $orientation = self::ORIENTATION_HORIZONTAL;
    private $values;


    /**
     *
     * @param string $value option value
     * @param string $label option label
     * @param bool $checked
     * @return $this
     * @TODO: allow to set multiple checked fields
     */
    public function addOption($value, $label, $checked = false)
    {
        $this->values[$value] = $label;

        if ($checked) {
            $this->checkedOption = $value;
        }

        return $this;
    }

    public function getOrientation()
    {
        return $this->orientation;
    }

    public function setOrientation($orientation)
    {
        $this->orientation = $orientation;
        return $this;
    }

    public function getMultiple()
    {
        return $this->multiple;
    }

    public function getExpanded()
    {
        return $this->expanded;
    }

    public function getCheckedOption()
    {
        return $this->checkedOption;
    }

    public function getValues()
    {
        return $this->values;
    }

    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
        return $this;
    }

    public function setExpanded($expanded)
    {
        $this->expanded = $expanded;
        return $this;
    }

    public function setCheckedOption($checkedOption)
    {
        $this->checkedOption = $checkedOption;
        return $this;
    }

    public function setValues($values)
    {
        $this->values = $values;
        return $this;
    }


    /**
     * Creates ChoiceInput from data passed in array.
     * @param $data
     * @return $this
     */
    public static function fromArray($data)
    {
        return (new self())
            ->setLabel($data['label'])
            ->setRequired($data['required'])
            ->setValidators($data['validators'] ?? [])
            ->setName($data['name'])
            ->setValue($data['value'] ?? null)
            ->setMultiple($data['multiple'])
            ->setValues($data['values'])
            ->setOrientation($data['orientation'] ?? self::ORIENTATION_HORIZONTAL)
            ->setExpanded($data['expanded'])
            ->setClass($data['class'] ?? null);
    }
}
