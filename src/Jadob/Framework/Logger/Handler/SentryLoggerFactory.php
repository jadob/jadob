<?php

namespace Jadob\Framework\Logger\Handler;

use Monolog\Handler\GroupHandler;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;

class SentryLoggerFactory implements HandlerFactoryInterface
{

    public function create(array $params): HandlerInterface
    {
        return new GroupHandler([
            new \Sentry\Monolog\BreadcrumbHandler(
                hub: \Sentry\SentrySdk::getCurrentHub(),
                level: Logger::INFO, // Take note of the level here, messages with that level or higher will be attached to future Sentry events as breadcrumbs
            ),
            new Handler(
                hub: SentrySdk::getCurrentHub(),
                level: $params['level'],
            ),
        ]);
    }
}