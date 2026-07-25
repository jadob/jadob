<?php

namespace Jadob\Contracts\DependencyInjection;

/**
 * Resolved to real value in runtime.
 */
final readonly class Reference
{
    public function __construct(
        private ReferenceType $type,
        private string $value,
    )
    {
    }

    public static function env(string $envName): self
    {

    }

    public static function literal(mixed $value): self
    {

    }

    public static function param(string $paramName): self
    {
        return new self(
            ReferenceType::Param,
            $paramName
        );
    }
}