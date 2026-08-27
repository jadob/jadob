<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use LogicException;

class LoggerConfig implements ConfigNodeInterface
{
    /**
     * @var array<string>
     */
    private(set) array $channels = [];

    /**
     * @var array<string, LoggerHandlerConfig>
     */
    private(set) array $handlers = [];

    public function __construct(
        private(set) string $defaultLoggerChannel = 'default',
        private(set) string $defaultErrorLoggerChannel = 'error',
    ) {
    }

    public function withDefaultLoggerChannel(
        string $channel,
    ): self {
        $this->defaultLoggerChannel = $channel;

        return $this;
    }

    public function withLoggerChannel(
        string $channel,
    ): self {
        $this->channels[] = $channel;

        return $this;
    }

    public function withDefaultErrorLoggerChannel(
        string $channel,
    ): self {
        $this->defaultErrorLoggerChannel = $channel;

        return $this;
    }

    public function configureStreamHandler(
        string $handlerName,
        array $channels,
        int $level,
        string $stream
    ): self {
        $this->handlers[$handlerName] = new LoggerHandlerConfig(
            type: 'stream',
            level: $level,
            parameters: [
                'stream' => $stream,
            ],
            channels: $channels,
        );

        return $this;
    }

    public function configureHandler(
        string $handlerName,
    ): LoggerHandlerConfig {
        if (!isset($this->handlers[$handlerName])) {
            throw new LogicException(
                sprintf(
                    'Cannot modify handler "%s" as it is not found. use withHandler() to define new handler.',
                    $handlerName
                )
            );
        }

        return $this->handlers[$handlerName];
    }
}