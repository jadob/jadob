<?php

namespace Jadob\FeatureFlag;

use Jadob\FeatureFlag\Condition\ConditionInterface;

/**
 * Class ToggleRouter
 * @package Jadob\FeatureFlag
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ToggleRouter
{
    /**
     * @var array
     */
    protected $conditions = [];

    /**
     * @var array 
     */
    protected $config;

    /**
     * ToggleRouter constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @param ConditionInterface $condition
     * @return $this
     */
    public function addCondition(ConditionInterface $condition)
    {
        $this->conditions[] = $condition;
        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isEnabled($name)
    {
        return false;
    }
}