<?php
namespace Slice\Core\Tests;

use PHPUnit\Framework\TestCase;
use Slice\Core\Framework;

class FrameworkTest extends TestCase
{
    public function testForFrameworkProperlyGetsDevEnvironment()
    {
        $framework = new Framework('dev');
        $this->assertFalse($framework->isProductionEnvironment());
    }
}
