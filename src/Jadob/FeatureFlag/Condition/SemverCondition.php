<?php

namespace Jadob\FeatureFlag\Condition;

/**
 * Example usage:
 * First: min and max provided
 *
 * $cond = new SemverCondition('php_version', '5.5.0', '7.1.0');
 *
 * $cond->verifyFeature('7.2.0') === false
 * $cond->verifyFeature('5.6.0') === true
 * $cond->verifyFeature('5.5.0') === true
 *
 * Second: only min provided
 *
 * $cond = new SemverCondition('php_version', '5.5.0');
 *
 * $cond->verifyFeature('7.2.0') === true
 * $cond->verifyFeature('5.6.0') === true
 * $cond->verifyFeature('5.5.0') === true
 *
 * Third: only max provided
 *
 * $cond = new SemverCondition('php_version', null '7.1.0');
 *
 * $cond->verifyFeature('7.2.0') === false
 * $cond->verifyFeature('7.1.0') === true
 * $cond->verifyFeature('5.5.0') === true
 **
 * This condition relies on built-in \version_compare function
 * @see https://www.php.net/manual/en/function.version-compare.php
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class SemverCondition implements ConditionInterface
{

    /**
     * @var string
     */
    protected $conditionKey;

    /**
     * @var string|null
     */
    protected $minVersion;

    /**
     * @var string|null
     */
    protected $maxVersion;

    /**
     * SemverCondition constructor.
     * @param string $conditionKey
     * @param null|string $minVersion
     * @param null|string $maxVersion
     */
    public function __construct(string $conditionKey, ?string $minVersion = null, ?string $maxVersion = null)
    {
        $this->conditionKey = $conditionKey;
        $this->minVersion = $minVersion;
        $this->maxVersion = $maxVersion;
    }

    public function verifyFeature($conditions): bool
    {
        // TODO: Implement verifyFeature() method.
    }

    /**
     * @return string
     */
    public function getConditionKey(): string
    {
        return $this->conditionKey;
    }
}