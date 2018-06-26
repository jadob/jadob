<?php

namespace Jadob\Debug\Handler;

/**
 * Interface ExceptionHandlerInterface
 * @package Jadob\Debug\Handler
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface ExceptionHandlerInterface
{
    public function handleExceptionAction(\Throwable $exception);
}