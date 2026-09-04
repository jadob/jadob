<?php
declare(strict_types=1);

namespace Jadob\Framework\Logger;

use function in_array;

final class HandlerConfiguration
{
    /**
     * @param string $type
     * @param array $channels
     * @param array<string, string|int> $parameters
     */
    public function __construct(
        private(set) string $type,
        private(set) string $level,
        private array $channels,
        private(set) array $parameters
    ) {
    }

    public function supportsChannel(
        string $channel,
    ): bool {
        return in_array(
            $channel,
            $this->channels,
            true
        );
    }
}