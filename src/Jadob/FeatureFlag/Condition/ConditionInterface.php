<?php

namespace Jadob\FeatureFlag\Condition;

/**
 * Interface ConditionInterface
 *
 * @package Jadob\FeatureFlag\Condition
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface ConditionInterface
{
    public function verifyFeature($conditions): bool;

    public function getConditionKey(): string;

}