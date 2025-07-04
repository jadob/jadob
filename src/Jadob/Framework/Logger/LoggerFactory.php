<?php

declare(strict_types=1);

namespace Jadob\Framework\Logger;

use Jadob\Core\BootstrapInterface;
use LogicException;
use Monolog\Handler\GroupHandler;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Sentry\Monolog\Handler;
use Sentry\SentrySdk;

class LoggerFactory
{
    private array $loggers = [];
    private array $handlers = [];

    public function __construct(
        private BootstrapInterface $bootstrap,
        private string             $defaultLoggerChannel,
        private string             $defaultErrorLoggerChannel,
        private array              $channelsConfig = [],
        private array              $handlersConfig = [],
    ) {
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


            if (!array_key_exists($channel, $this->channelsConfig)) {
                throw new LogicException(
                    sprintf(
                        'Logger channel "%s" does not have any configuration.',
                        $channel
                    )
                );
            }

            foreach ($this->channelsConfig[$channel] as $handlers) {
                $logger->pushHandler(
                    $this->getOrCreateHandler($handlers)
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

            if ($config['type'] === 'stream' && $config['rotating']) {
                $handler = new RotatingFileHandler(
                    filename: $this->resolvePath($config['path']),
                    level: $config['level'],
                );
            } elseif ($config['type'] === 'stream' && !$config['rotating']) {
                $handler = new StreamHandler(
                    stream: $this->resolvePath($config['path']),
                    level: $config['level'],
                );
            } elseif($config['type'] === 'sentry') {
                $handler = new GroupHandler([
                    new \Sentry\Monolog\BreadcrumbHandler(
                        hub: \Sentry\SentrySdk::getCurrentHub(),
                        level: Logger::INFO, // Take note of the level here, messages with that level or higher will be attached to future Sentry events as breadcrumbs
                    ),
                    new Handler(
                        hub: SentrySdk::getCurrentHub(),
                        level: $config['level'],
                    ),
                ]);
            } else {
                throw new LogicException(
                    sprintf('Unsupported handler: %s', $handlerName)
                );
            }

            $this->handlers[$handlerName] = $handler;
        }

        return $this->handlers[$handlerName];
    }

    public function resolvePath(string $path): string
    {
        return str_replace('%log_dir%', $this->bootstrap->getLogsDir(), $path);
    }
}