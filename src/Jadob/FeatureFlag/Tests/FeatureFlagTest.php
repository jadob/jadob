<?php

namespace Jadob\FeatureFlag\Tests;

use Jadob\FeatureFlag\Condition\BooleanCondition;
use Jadob\FeatureFlag\FeatureFlag;
use PHPUnit\Framework\TestCase;

class FeatureFlagTest extends TestCase
{

    public function testBasicFeatureFlag(): void
    {

        $config = [
            'example' => [
                'enabled' => true
            ]
        ];

        $featureFlag = new FeatureFlag($config);
        $booleanCondition = new BooleanCondition('enabled');
        $featureFlag->addCondition($booleanCondition);
        $this->assertTrue($featureFlag->isEnabled('example'));

    }

    public function testBasicFeatureFlagButFeatureIsDisabled(): void
    {

        $config = [
            'example' => [
                'enabled' => false
            ]
        ];

        $featureFlag = new FeatureFlag($config);
        $booleanCondition = new BooleanCondition('enabled');
        $featureFlag->addCondition($booleanCondition);
        $this->assertFalse($featureFlag->isEnabled('example'));

    }

    /**
     * @expectedException \Jadob\FeatureFlag\Exception\MissingFeatureRulesException
     *
     * @expectedExceptionMessage Feature "missing" is not defined.
     *
     * @return void
     */
    public function testBasicFeatureFlagButFeatureIsMissing(): void
    {

        $config = [
            'example' => [
                'enabled' => false
            ]
        ];

        $featureFlag = new FeatureFlag($config);
        $booleanCondition = new BooleanCondition('enabled');
        $featureFlag->addCondition($booleanCondition);

        $featureFlag->isEnabled('missing');
    }
}