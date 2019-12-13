<?php

namespace Jadob\Router\Tests;

use Jadob\Security\Encoder\BCryptEncoder;
use PHPUnit\Framework\TestCase;

/**
 * Class BcryptEncoderTest
 *
 * @package Jadob\Security\Tests
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class BCryptEncoderTest extends TestCase
{
    public function testBcryptEncoder()
    {

        $rawPassword = 'myv3ryhardp@ssw06d';

        $encoder = new BCryptEncoder(10);
        $hash = $encoder->encode($rawPassword);

        $this->assertNotContains($rawPassword, $hash);
        $this->assertTrue($encoder->compare($rawPassword, $hash));
    }


    /**
     * @expectedException \RuntimeException
     */
    public function testTooLowCostPassedInConstructor()
    {
        new BCryptEncoder(2);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testTooHighCostPassedInConstructor()
    {
        new BCryptEncoder(32);
    }
}