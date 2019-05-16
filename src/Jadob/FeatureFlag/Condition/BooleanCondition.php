<?php

namespace Jadob\FeatureFlag\Condition;

/**
 * Class BooleanCondition
 * @package Jadob\FeatureFlag\Condition
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class BooleanCondition implements ConditionInterface
{

    /**
     * @var string
     */
    protected $conditionKey;

    /**
     * BooleanCondition constructor.
     * @param string $conditionKey
     */
    public function __construct(string $conditionKey)
    {
        $this->conditionKey = $conditionKey;
    }

    /**
     * @param $conditions
     * @return bool
     */
    public function verifyFeature($conditions)
    {
        return (bool)$conditions;
    }


    public function getConditionKey()
    {
        // TODO: Implement getConditionKey() method.
    }
}