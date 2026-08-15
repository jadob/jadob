<?php

declare(strict_types=1);

namespace Jadob\Framework\Logger;

use Jadob\Framework\Logger\HandlerFactory\LogHandlerFactoryInterface;
use LogicException;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use function array_key_exists;
use function sprintf;

class LoggerFactory
{
    private array $loggers = [];
    private array $handlers = [];

    /**
     * @param string $defaultLoggerChannel
     * @param string $defaultErrorLoggerChannel
     * @param array<string> $channelsConfig
     * @param array<string, HandlerConfiguration> $handlersConfig
     * @param array<string, LogHandlerFactoryInterface> $handlerFactories
     */
    public function __construct(
        private readonly string $defaultLoggerChannel,
        private readonly string $defaultErrorLoggerChannel,
        private readonly array  $channelsConfig = [],
        private readonly array  $handlersConfig = [],
        private array           $handlerFactories = [],
    )
    {
    }

    public function getDefaultLogger(): LoggerInterface
    {
        return $this->getOrCreateLogger($this->defaultLoggerChannel);
    }

    public function getDefaultErrorLogger(): LoggerInterface
    {
        return $this->getOrCreateLogger($this->defaultErrorLoggerChannel);
    }

    public function getLoggerForChannel(string $channel): LoggerInterface
    {
        return $this->getOrCreateLogger($channel);
    }

    private function getOrCreateLogger(string $channel): LoggerInterface
    {
        if (!array_key_exists($channel, $this->loggers)) {
            $logger = new Logger($channel);

            foreach ($this->handlersConfig as $handlerName => $handlerConfig) {
                if ($handlerConfig->supportsChannel($channel) === false) {
                    continue;
                }

                $logger->pushHandler(
                    $this->getOrCreateHandler($handlerName)
                );
            }
            $this->loggers[$channel] = $logger;
        }

        return $this->loggers[$channel];
    }

    private function getOrCreateHandler(string $handlerName): HandlerInterface
    {
        if (!array_key_exists($handlerName, $this->handlers)) {
            $config = $this->handlersConfig[$handlerName];
            $factory = $this->getLogHandlerFactoryForType($config->type);

            $this->handlers[$handlerName] = $factory->create(
                parameters: $config->parameters,
                level: $config->level
            );
        }

        return $this->handlers[$handlerName];
    }

    private function getLogHandlerFactoryForType(
        string $type
    ): LogHandlerFactoryInterface
    {
        foreach ($this->handlerFactories as $handlerFactory) {
            if($handlerFactory->supports($type)) {
                return $handlerFactory;
            }
        }

        throw new LogicException(
            sprintf(
            'There is no log handler factory for type "%s"',
                $type
            )
        );
    }
}