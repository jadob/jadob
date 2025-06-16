<?php

namespace Jadob\Framework\Logger\Handler;

use Monolog\Handler\HandlerInterface;

interface HandlerFactoryInterface
{

    public function create(array $params): HandlerInterface;
}