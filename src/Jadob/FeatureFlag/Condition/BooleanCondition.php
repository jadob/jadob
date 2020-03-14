<?php

namespace Jadob\FeatureFlag\Condition;

/**
 * You can use this class for creating boolean conditions in feature flags.
 *
 * Warning: this class assumes that condition must be equal true to make it enabled.
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
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
     *
     * @param string $conditionKey
     */
    public function __construct(string $conditionKey)
    {
        $this->conditionKey = $conditionKey;
    }

    /**
     * @param $conditions
     * @param true $conditions
     *
     * @return bool
     */
    public function verifyFeature($conditions): bool
    {
        return (bool)$conditions;
    }

    /**
     * @return string
     */
    public function getConditionKey(): string
    {
        return $this->conditionKey;
    }
}