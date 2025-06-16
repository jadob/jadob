<?php

namespace Jadob\Framework\Logger\Handler;

use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;

class RotatingFileHandlerFactory implements HandlerFactoryInterface
{

    public function create(array $params): HandlerInterface
    {
       return  new RotatingFileHandler(
           filename: $params['path'],
           level: $params['level'],
       );
    }
}