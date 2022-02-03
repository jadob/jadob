<?php
declare(strict_types=1);

namespace Jadob\FeatureFlag;

use Jadob\FeatureFlag\Condition\ConditionInterface;
use Jadob\FeatureFlag\Exception\MissingFeatureRulesException;

/**
 * Allows to enable/disable features in app depending on passed conditions.
 *
 * How does config array should look like:
 *
 * 'feature_name' => [
 *      'enabled' => true|false,
 *      'request' => [
 *          'host' => string|string[],
 *          'method'  => string|string[],
 *          'ip' => string|string[]
 *      ],
 *      'user' => [
 *          'id' => int|int[],
 *          'username' => string|string[],
 *          'role' => string|string[]
 *      ]
 * ]
 *
 * @see     https://martinfowler.com/articles/feature-toggles.html
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class FeatureFlag
{

    /**
     * @var ConditionInterface[]
     */
    protected $conditions;

    /**
     * @var array
     */
    protected $config;

    /**
     * FeatureFlag constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @param  ConditionInterface $condition
     * @return FeatureFlag
     */
    public function addCondition(ConditionInterface $condition): self
    {
        $this->conditions[$condition->getConditionKey()] = $condition;
        return $this;
    }

    /**
     * @param  string $name
     * @return bool
     * @throws MissingFeatureRulesException
     */
    public function isEnabled($name): bool
    {
        if (!isset($this->config[$name])) {
            throw new MissingFeatureRulesException('Feature "'.$name.'" is not defined.');
        }

        $rulesForFeature = $this->config[$name];

        foreach ($rulesForFeature as $key => $value) {
            $result = $this->conditions[$key]->verifyFeature($value);

            if (!$result) {
                return false;
            }
        }

        return true;
    }
}