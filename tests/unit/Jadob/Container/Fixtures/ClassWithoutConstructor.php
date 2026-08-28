<?php

namespace Jadob\Container\Fixtures;

class ClassWithoutConstructor
{

    public function __invoke(\DateTimeInterface $time)
    {
        // TODO: Implement __invoke() method.
    }
}