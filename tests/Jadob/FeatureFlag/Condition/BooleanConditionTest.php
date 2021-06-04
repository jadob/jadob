<?php
declare(strict_types=1);

namespace Jadob\FeatureFlag\Condition;

use PHPUnit\Framework\TestCase;

class BooleanConditionTest extends TestCase
{
    public function testConditionReturnsValidConditionKey(): void
    {
        $condition = new BooleanCondition('test1');
        $this->assertEquals('test1', $condition->getConditionKey());
    }

    public function testConditionVeryfingReturnsBooleanValues(): void
    {
        $condition = new BooleanCondition('test1');
        $this->assertTrue($condition->verifyFeature(true));
    }
}