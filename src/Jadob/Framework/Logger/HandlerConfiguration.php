<?php

namespace Jadob\Framework\Logger;

final class HandlerConfiguration
{
    /**
     * @param string $type
     * @param array $channels
     * @param array<string, string|int> $parameters
     */
    public function __construct(
        private string $type,
        private int $level,
        private array $channels,
        private array $parameters
    )
    {
    }
}