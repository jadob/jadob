<?php

namespace Jadob\Bridge\Monolog\Configuration;

use Psr\Log\LogLevel;

class LoggerConfiguration
{
    private array $channels = [];
    private array $handlers = [];

    public function configureHandler(
        string $name,
        array $params,
    ): self
    {

    }

    public function configureChannel(
        string   $name,
        LogLevel $level,
        array    $handlers = []
    ): self
    {

    }
}