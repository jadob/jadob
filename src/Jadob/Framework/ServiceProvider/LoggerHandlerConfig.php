<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

final class LoggerHandlerConfig
{
    /**
     * @param array<string, string|int> $parameters
     * @param array<string> $channels
     */
    public function __construct(
        private(set) ?string $type = null,
        private(set) ?string $level = null,
        private(set) array $parameters = [],
        private(set) array $channels = []
    ) {
    }

    public function withType(
        string $type,
    ): self {
        $this->type = $type;

        return $this;
    }

    public function withLevel(
        string $level,
    ): self {
        $this->level = $level;

        return $this;
    }

    public function withParameters(
        array $parameters
    ): self {
        $this->parameters = $parameters;

        return $this;
    }

    public function withChannel(
        string $channel,
    ): self {
        $this->channels[] = $channel;

        return $this;
    }
}