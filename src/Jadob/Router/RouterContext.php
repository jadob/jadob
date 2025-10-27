<?php
declare(strict_types=1);

namespace Jadob\Router;

use Jadob\Router\Exception\RouterException;
use function explode;
use function strlen;
use function substr;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
final readonly class RouterContext
{
    public function __construct(
        private ?string $host = null,
        private ?bool $secure = false,
        private ?int $port = null,
        private(set) ?string $basePath = null,
    )
    {
    }
}