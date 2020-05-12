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

        $this->assertTrue($encoder->compare($rawPassword, $hash));
    }


    public function testTooLowCostPassedInConstructor(): void
    {
        $this->expectException(\RuntimeException::class);
        new BCryptEncoder(2);
    }

    public function testTooHighCostPassedInConstructor(): void
    {
        $this->expectException(\RuntimeException::class);
        new BCryptEncoder(32);
    }
}