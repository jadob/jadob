<?php

namespace Jadob\Core\Tests;

use Jadob\Core\Exception\KernelException;
use Jadob\Core\Kernel;
use PHPUnit\Framework\TestCase;

/**
 * Class KernelTest
 * @package Jadob\Core\Tests
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class KernelTest extends TestCase
{

    /**
     * @throws KernelException
     * @throws \Exception
     */
    public function testKernelCannotBeCreatedWithInvalidEnvironmentPassed()
    {
        $this->expectException(KernelException::class);

        new Kernel('invalid', new Bootstrap());
    }
}