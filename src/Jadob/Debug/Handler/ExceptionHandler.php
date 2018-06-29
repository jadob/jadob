<?php

namespace Jadob\Debug\Handler;

use Jadob\Stdlib\StaticEnvironmentUtils;
use Psr\Log\LoggerInterface;
use ErrorException;
use Jadob\Debug\ExceptionView;
use Jadob\Debug\Interfaces\PageNotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ExceptionHandler
 * @package Jadob\Debug\Handler
 * @license MIT
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
     * @var ExceptionHandlerInterface
     */
    protected $customProductionHandler;

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

    public function exceptionHandler(\Throwable $exception)
    {
        $this->logger->error($exception->getMessage(), $exception->getTrace());

        if (StaticEnvironmentUtils::isCli()) {
            $this->showCliError($exception);
            return;
        }

        if ($this->environment === 'prod') {
            $this->showProductionErrorPage($exception);
            return;
        }

        $this->showDevelopmentErrorPage($exception);

    }

    protected function showCliError(\Throwable $exception)
    {
        print($exception->getMessage() . ' in ' . $exception->getFile() . ':' . $exception->getLine() . PHP_EOL);
    }

    protected function showProductionErrorPage($exception)
    {

        if ($this->customProductionHandler !== null) {

            /** @var Response $response */
            $response = $this->customProductionHandler->handleExceptionAction($exception);

            $response->send();
            return;
        }


        $template = 'service-temporarily-unavailable';
        $code = 503;

        if (\in_array(PageNotFoundExceptionInterface::class, class_implements($exception), true)) {
            $template = 'not-found';
            $code = 404;
        }

        http_response_code($code);
        ExceptionView::showErrorPage($template, 'prod');
    }

    protected function showDevelopmentErrorPage($exception)
    {
        http_response_code(500);
        ExceptionView::showErrorPage('error', 'dev', [
            'exception' => $exception
        ]);
    }

    /**
     * @return ExceptionHandlerInterface
     */
    public function getCustomProductionHandler(): ExceptionHandlerInterface
    {
        return $this->customProductionHandler;
    }

    /**
     * @param ExceptionHandlerInterface $customProductionHandler
     * @return ExceptionHandler
     */
    public function setCustomProductionHandler(ExceptionHandlerInterface $customProductionHandler): ExceptionHandler
    {
        $this->customProductionHandler = $customProductionHandler;
        return $this;
    }
}