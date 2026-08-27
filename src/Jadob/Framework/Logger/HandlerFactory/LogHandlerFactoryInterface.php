<?php
declare(strict_types=1);

namespace Jadob\Framework\Logger\HandlerFactory;

use Monolog\Handler\HandlerInterface;

interface LogHandlerFactoryInterface
{
    public function create(
        array $parameters,
        string $level
    ): HandlerInterface;

    public function supports(
        string $type
    ): bool;
}