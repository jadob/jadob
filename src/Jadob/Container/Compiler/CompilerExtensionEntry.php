<?php

namespace Jadob\Container\Compiler;

use Jadob\Contracts\DependencyInjection\CompilerExtensionInterface;

/**
 * @internal
 */
final readonly class CompilerExtensionEntry
{

    public function __construct(
        private(set) CompilerExtensionInterface $extension,
        private(set) string $id,
        private(set) int $priority
    )
    {}
}