<?php
namespace Slice\Debug\Handler;

use Slice\Debug\Interfaces\PageNotFoundExceptionInterface;
use Throwable;
use ErrorException;
use Slice\Core\Environment;

/**
 * Class ExceptionHandler
 * @package Slice\Debug\Handler
 */
class ExceptionHandler
{
    /**
     * @var Environment
     */
    protected $environment;

    /**
     * ExceptionHandler constructor.
     * @param Environment $environment
     */
    public function __construct(Environment $environment)
    {
        $this->environment = $environment;
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
        if ($this->environment->isProduction()) {
            $this->showProductionErrorPage($exception);
            return;
        }

        $this->showDevelopmentErrorPage($exception);

    }

    protected function showProductionErrorPage(Throwable $exception)
    {
        if (in_array(PageNotFoundExceptionInterface::class, class_implements($exception), true)) {
            http_response_code(404);
            echo '404';
            return;
        }
        http_response_code(503);
        require_once __DIR__.'/../Resources/templates/prod/service-temporarily-unavailable.php';
    }

    protected function showDevelopmentErrorPage(Throwable $exception)
    {
        r($exception, $exception->getTrace());
    }
}