<?php

namespace Jadob\Contracts\DependencyInjection\Attribute;

#[\Attribute(\Attribute::TARGET_PARAMETER | \Attribute::TARGET_PROPERTY)]
final readonly class InjectTaggedServices
{
    public function __construct(
        private(set) string $tag
    )
    {
    }
}