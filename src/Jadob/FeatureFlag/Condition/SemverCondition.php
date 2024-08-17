<?php
declare(strict_types=1);

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
 * *
 * This condition relies on built-in \version_compare function
 *
 * @see     https://www.php.net/manual/en/function.version-compare.php
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
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
     *
     * @param string      $conditionKey - soon to be dropped
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
        //check only min version
        if ($this->maxVersion === null && $this->minVersion !== null) {
            //greater or equal
            return \version_compare($conditions, $this->minVersion, 'ge');
        }

        //check only max version
        if ($this->maxVersion !== null && $this->minVersion === null) {
            //lower or equal
            return \version_compare($conditions, $this->maxVersion, 'le');
        }

        //check both of them
        return \version_compare($conditions, $this->minVersion, 'ge')
            && \version_compare($conditions, $this->maxVersion, 'le');
    }

    /**
     * @return string
     */
    public function getConditionKey(): string
    {
        return $this->conditionKey;
    }
}