<?php
declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY)]
final readonly class InjectTaggedServices
{
    public function __construct(
        private(set) string $tag
    ) {
    }
}