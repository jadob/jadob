<?php

namespace Jadob\Container\Fixtures;

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