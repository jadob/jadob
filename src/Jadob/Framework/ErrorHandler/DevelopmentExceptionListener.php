<?php

declare(strict_types=1);

namespace Jadob\Framework\ErrorHandler;

use Jadob\Framework\Event\ExceptionEvent;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class DevelopmentExceptionListener implements ExceptionListenerInterface, LoggerAwareInterface
{
    private ?LoggerInterface $logger = null;

    public function handleExceptionEvent(ExceptionEvent $event): void
    {
        ob_start();
        include_once __DIR__.'/templates/error_view.php';
        $content = ob_get_contents();
        $event->setResponse(new Response($content));
        $event->stopPropagation();

        $this->logger?->critical(
            $event->getException(),
            $event->getException()->getTrace()
        );
    }

    public function setLogger(LoggerInterface $logger): void
    {
       $this->logger = $logger;
    }


    /**
     * TODO Move to another class
     * @param $variable
     * @return string
     */
    public static function getVariableType($variable)
    {
        if ($variable === null) {
            return 'null';
        }
        if (is_string($variable)) {
            if (strlen($variable) === 0) {
                return '""';
            }

            return $variable;
        }
        if (is_scalar($variable)) {
            return 'scalar';
        }
        if (is_object($variable)) {
            return get_class($variable);
        }
        if (is_array($variable)) {
            return 'array';
        }
        if (is_resource($variable)) {
            return 'resource';
        }
        return 'unknown';
    }

    /**
     * TODO Move to another class
     * @param $params
     * @return string
     */
    public static function parseParams($params)
    {
        $output = [];
        if (!is_array($params)) {
            return htmlspecialchars(self::getVariableType($params));
        }
        foreach ($params as $param) {
            $output[] = htmlspecialchars(self::getVariableType($param));
        }
        return implode(',', $output);
    }
}