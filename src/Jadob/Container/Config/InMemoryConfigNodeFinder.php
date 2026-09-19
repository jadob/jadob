<?php

declare(strict_types=1);

namespace Jadob\Container\Config;

use Closure;

/**
 * Use this class for testing or smaller apps when there is no need for configs to be spread across multiple files.
 * @license MIT
 */
final readonly class InMemoryConfigNodeFinder implements ConfigNodeFinderInterface
{
    /**
     * @param array<string, Closure[]> $nodes
     */
    public function __construct(
        private array $nodes
    ) {
    }

    public function find(string $node): array
    {
        return $this->nodes[$node] ?? [];
    }
}