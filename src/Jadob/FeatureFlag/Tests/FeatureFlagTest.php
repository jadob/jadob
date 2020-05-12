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

    public function testBasicFeatureFlagButFeatureIsMissing(): void
    {
        $this->expectException(\Jadob\FeatureFlag\Exception\MissingFeatureRulesException::class);
        $this->expectExceptionMessage('Feature "missing" is not defined.');

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