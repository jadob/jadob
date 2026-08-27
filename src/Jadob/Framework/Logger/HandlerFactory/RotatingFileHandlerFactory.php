<?php
declare(strict_types=1);

namespace Jadob\Framework\Logger\HandlerFactory;

use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;

final readonly class RotatingFileHandlerFactory implements LogHandlerFactoryInterface
{
    public function create(
        array $parameters,
        string $level
    ): HandlerInterface {
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