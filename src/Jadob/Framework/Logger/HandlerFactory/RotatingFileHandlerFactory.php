<?php

namespace Jadob\Framework\Logger\HandlerFactory;

use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;

final readonly class RotatingFileHandlerFactory implements LogHandlerFactoryInterface
{
    public function create(
        array $parameters,
        string $level
    ): HandlerInterface
    {
        return new RotatingFileHandler(
            filename: $parameters['file'],
            level: $level,
        );
    }

    public function supports(string $type): bool
    {
        return $type === 'rotating_file';
    }
}