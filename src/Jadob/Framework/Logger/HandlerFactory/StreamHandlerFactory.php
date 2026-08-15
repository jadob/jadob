<?php

namespace Jadob\Framework\Logger\HandlerFactory;

use Monolog\Handler\HandlerInterface;
use Monolog\Handler\StreamHandler;

final readonly class StreamHandlerFactory implements LogHandlerFactoryInterface
{
    public function create(
        array $parameters,
        string $level
    ): HandlerInterface
    {
        return new StreamHandler(
            stream: $parameters['stream'],
            level: $level,
        );
    }
}