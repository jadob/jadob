<?php
declare(strict_types=1);

namespace Jadob\Router;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
final readonly class RouterContext
{
    public function __construct(
        private(set) ?string $host = null,
        private(set) ?bool $secure = false,
        private(set) ?int $port = null,
        private(set) ?string $basePath = null,
    ) {
    }
}