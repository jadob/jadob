<?php
declare(strict_types=1);

namespace Jadob\FeatureFlag\Condition;

/**
 * Interface ConditionInterface
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface ConditionInterface
{
    public function verifyFeature($conditions): bool;

    public function getConditionKey(): string;
}