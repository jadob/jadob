<?php

namespace Jadob\Contracts\DependencyInjection;

/**
 * Resolved to real value in runtime.
 */
final readonly class Reference
{
    public function __construct(
        private(set) ReferenceType $type,
        private(set) string $value,
    )
    {
    }

    public static function env(string $envName): self
    {

    }

    public static function literal(mixed $value): self
    {

    }

    public static function service(string $serviceId): self
    {
        return new self(
            ReferenceType::Service,
            $serviceId,
        );
    }

    public static function taggedServices(string $tag): self
    {
        return new self(
            ReferenceType::TaggedServices,
            $tag,
        );
    }

    public static function param(string $paramName): self
    {
        return new self(
            ReferenceType::Param,
            $paramName
        );
    }
}