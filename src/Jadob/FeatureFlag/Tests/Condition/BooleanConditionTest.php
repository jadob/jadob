<?php

namespace Jadob\FeatureFlag\Tests\Condition;

use Jadob\FeatureFlag\Condition\BooleanCondition;
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