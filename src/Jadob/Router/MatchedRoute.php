<?php

namespace Jadob\Router;

/**
 * @license MIT
 */
final readonly class MatchedRoute
{
    public function __construct(
        private(set) Route $route,
        /**
         * @var array<non-empty-string, string>
         */
        private(set) array $pathParameters,
    )
    {
    }
}