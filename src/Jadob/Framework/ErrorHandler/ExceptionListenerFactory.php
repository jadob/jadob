<?php

namespace Jadob\Framework\ErrorHandler;

class ExceptionListenerFactory
{
    public static function createForEnv(string $env): ExceptionListenerInterface
    {
        if($env === 'dev') {
            return new DevelopmentExceptionListener();
        }

    }
}