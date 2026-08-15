<?php

namespace Jadob\Framework\ServiceProvider;

/**
 * @internal
 */
final readonly class LoggerHandlerConfig
{
    /**
     * @param array<string, string|int> $parameters
     * @param array<string> $channels
     */
    public function __construct(
        private(set) string $type,
        private(set) int $level,
        private(set) array $parameters,
        private(set) array $channels,

    )
    {
    }

}