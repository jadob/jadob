<?php

namespace Jadob\Container;

use Jadob\Container\Fixtures\ExampleService;
use PHPUnit\Framework\TestCase;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DefinitionTest extends TestCase
{

    public function testTagging()
    {
        $definition = new Definition(ExampleService::class);

        $definition->addTag('leszke');

        self::assertEquals('leszke', $definition->getTags()[0]);
    }
}