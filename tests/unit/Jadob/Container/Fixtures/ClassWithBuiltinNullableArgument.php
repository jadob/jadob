<?php

declare(strict_types=1);

namespace Jadob\Container\Fixtures;

class ClassWithBuiltinNullableArgument
{
    public function __construct(
        private ?string $name = null,
    )
    {
    }
}