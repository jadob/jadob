<?php

namespace Jadob\FeatureFlag\Condition;

/**
 * Interface ConditionInterface
 * @package Jadob\FeatureFlag\Condition
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface ConditionInterface
{
    public function verifyFeature($conditions);

    public function getConditionKey();

}