<?php

namespace Jadob\FeatureFlag\Tests\Condition;

use Jadob\FeatureFlag\Condition\SemverCondition;
use PHPUnit\Framework\TestCase;

/**
 * Class SemverConditionTest
 * @package Jadob\FeatureFlag\Tests\Condition
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class SemverConditionTest extends TestCase
{


    public function testOnlyMinVersionPassed()
    {
        $condition = new SemverCondition('version', '5.4.0');
        $this->assertTrue($condition->verifyFeature('5.4.1'));
        $this->assertTrue($condition->verifyFeature('5.4.0'));
        $this->assertFalse($condition->verifyFeature('5.3.9'));
    }

    public function testOnlyMaxVersionPassed()
    {
        $condition = new SemverCondition('version', null, '5.4.0');
        $this->assertFalse($condition->verifyFeature('6'));
        $this->assertTrue($condition->verifyFeature('5.4.0'));
        $this->assertTrue($condition->verifyFeature('5.3.9'));
    }

    public function testBothMaxAndMinVersionPassed()
    {
        $condition = new SemverCondition('version', '2.3.4', '5.4.0');
        $this->assertTrue($condition->verifyFeature('5.4.0'));
        $this->assertTrue($condition->verifyFeature('2.3.4'));
        $this->assertTrue($condition->verifyFeature('3.0.0'));
        $this->assertFalse($condition->verifyFeature('1.0.1'));
        $this->assertFalse($condition->verifyFeature('2.3.3'));
        $this->assertFalse($condition->verifyFeature('6.1.0'));
        $this->assertFalse($condition->verifyFeature('6'));
    }

    public function testConditionKey()
    {
        $condition = new SemverCondition('version');
        $this->assertEquals('version', $condition->getConditionKey());
    }
}