<?php

namespace Jadob\Framework\Logger\HandlerFactory;

use Monolog\Handler\HandlerInterface;

interface LogHandlerFactoryInterface
{
    public function create(
        array $parameters,
        string $level
    ): HandlerInterface;
}