<?php

namespace Jadob\Debug\Handler;

use Psr\Log\LoggerInterface;
use ErrorException;
use Jadob\Debug\ExceptionView;
use Jadob\Debug\Interfaces\PageNotFoundExceptionInterface;

/**
 * Class ExceptionHandler
 * @package Jadob\Debug\Handler
 */
class ExceptionHandler
{
    /**
     * @var string
     */
    protected $environment;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * ExceptionHandler constructor.
     * @param string $environment
     */
    public function __construct($environment, LoggerInterface $logger)
    {
        $this->environment = $environment;
        $this->logger = $logger;
    }

    public function registerErrorHandler()
    {
        set_error_handler([$this, 'errorHandler']);

        return $this;
    }

    public function registerExceptionHandler()
    {
        set_exception_handler([$this, 'exceptionHandler']);

        return $this;
    }

    /**
     * @param $severity
     * @param $message
     * @param $file
     * @param $line
     * @throws ErrorException
     */
    public function errorHandler($severity, $message, $file, $line)
    {
        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    public function exceptionHandler(\Exception $exception)
    {
        $this->logger->error($exception->getMessage(), $exception->getTrace());

        if ($this->environment === 'prod') {
            $this->showProductionErrorPage($exception);
            return;
        }

        $this->showDevelopmentErrorPage($exception);

    }

    protected function showProductionErrorPage( $exception)
    {
        $template = 'service-temporarily-unavailable';
        $code = 503;

        if (\in_array(PageNotFoundExceptionInterface::class, class_implements($exception), true)) {
            $template = 'not-found';
            $code = 404;
        }

        http_response_code($code);
        ExceptionView::showErrorPage($template, 'prod');
    }

    protected function showDevelopmentErrorPage( $exception)
    {
        ExceptionView::showErrorPage('error', 'dev', [
            'exception' => $exception
        ]);
    }
}