<?php

namespace Jadob\Contracts\DependencyInjection\Attribute;

#[\Attribute(\Attribute::TARGET_PARAMETER | \Attribute::TARGET_PROPERTY)]
final readonly class InjectService
{
    public function __construct(
        private(set) string $serviceId
    )
    {
    }
}