<?php

namespace Slice\Debug\Handler;

use Throwable;
use ErrorException;
use Slice\Debug\ExceptionView;
use Slice\Debug\Interfaces\PageNotFoundExceptionInterface;

/**
 * Class ExceptionHandler
 * @package Slice\Debug\Handler
 */
class ExceptionHandler
{
    /**
     * @var string
     */
    protected $environment;

    /**
     * ExceptionHandler constructor.
     * @param string $environment
     */
    public function __construct($environment)
    {
        $this->environment = $environment;
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

    }

    public function registerErrorHandler(): ExceptionHandler
    {
        set_error_handler([$this, 'errorHandler']);

        return $this;
    }

    public function registerExceptionHandler(): ExceptionHandler
    {
        set_exception_handler([$this, 'exceptionHandler']);

        return $this;
    }

    public function errorHandler($severity, $message, $file, $line)
    {
        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    public function exceptionHandler(Throwable $exception)
    {
        if ($this->environment === 'prod') {
            $this->showProductionErrorPage($exception);
            return;
        }

        $this->showDevelopmentErrorPage($exception);

    }

    protected function showProductionErrorPage(Throwable $exception)
    {
        $template = 'service-temporarily-unavailable';
        $code = 503;

        if (in_array(PageNotFoundExceptionInterface::class, class_implements($exception), true)) {
            $template = 'not-found';
            $code = 404;
        }

        http_response_code($code);
        ExceptionView::showErrorPage($template, 'prod');
    }

    protected function showDevelopmentErrorPage(Throwable $exception)
    {
        ExceptionView::showErrorPage('error', 'dev', [
            'exception' => $exception
        ]);
    }
}