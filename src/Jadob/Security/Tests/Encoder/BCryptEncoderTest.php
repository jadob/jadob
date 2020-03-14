<?php

namespace Jadob\Security\Tests\Encoder;

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
    public function testBcryptEncoder(): void
    {

        $rawPassword = 'myv3ryhardp@ssw06d';

        $encoder = new BCryptEncoder(10);
        $hash = $encoder->encode($rawPassword);

        $this->assertNotContains($rawPassword, $hash);
        $this->assertTrue($encoder->compare($rawPassword, $hash));
    }


    /**
     * @expectedException \RuntimeException
     *
     * @return void
     */
    public function testTooLowCostPassedInConstructor(): void
    {
        new BCryptEncoder(2);
    }

    /**
     * @expectedException \RuntimeException
     *
     * @return void
     */
    public function testTooHighCostPassedInConstructor(): void
    {
        new BCryptEncoder(32);
    }
}