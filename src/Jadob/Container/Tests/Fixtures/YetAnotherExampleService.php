<?php

namespace Jadob\Container\Tests\Fixtures;

/**
 * @internal
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 */
class YetAnotherExampleService
{

    public $example;

    public function setService(ExampleService $service): void
    {
        $this->example = $service;
    }

    public function getService()
    {
        return $this->example;
    }
}