<?php

declare(strict_types=1);

namespace Jadob\Container\Fixtures;

class ClassWithBuiltinNonNullableArgument
{
    public function __construct(
        private string $name,
    )
    {
    }
}