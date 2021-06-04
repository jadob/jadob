<?php
declare(strict_types=1);

namespace Jadob\Core;

use Jadob\Core\Exception\KernelException;
use Jadob\Core\Kernel;
use PHPUnit\Framework\TestCase;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class KernelTest extends TestCase
{

    /**
     * @throws KernelException
     * @throws \Exception
     *
     * @return void
     */
    public function testKernelCannotBeCreatedWithInvalidEnvironmentPassed(): void
    {
        $this->expectException(KernelException::class);

        new Kernel('invalid', new Bootstrap());
    }
}