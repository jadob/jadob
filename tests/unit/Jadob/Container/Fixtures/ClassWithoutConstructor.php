<?php

namespace Jadob\Container\Fixtures;

class ClassWithoutConstructor
{

    public function __invoke(\DateTimeInterface $time): void
    {
        // TODO: Implement __invoke() method.
    }
}