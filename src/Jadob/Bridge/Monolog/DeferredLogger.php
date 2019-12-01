<?php

declare(strict_types=1);

namespace Jadob\Bridge\Monolog;

use Monolog\Logger;
use Psr\Log\LoggerInterface;

class DeferredLogger implements LoggerInterface
{

    protected $logs = [];
    protected $logger;

    public function __construct(string $channel)
    {
        $this->logger = new Logger($channel);
    }

    public function flushLogs()
    {

    }

    public function __destruct()
    {
        $this->flushLogs();
    }

    /**
     * {@inheritDoc}
     */
    public function emergency($message, array $context = array())
    {
        // TODO: Implement emergency() method.
    }

    /**
     * {@inheritDoc}
     */
    public function alert($message, array $context = array())
    {
        // TODO: Implement alert() method.
    }

    /**
     * {@inheritDoc}
     */
    public function critical($message, array $context = array())
    {
        // TODO: Implement critical() method.
    }

    /**
     * {@inheritDoc}
     */
    public function error($message, array $context = array())
    {
        // TODO: Implement error() method.
    }

    /**
     * {@inheritDoc}
     */
    public function warning($message, array $context = array())
    {
        // TODO: Implement warning() method.
    }

    /**
     * {@inheritDoc}
     */
    public function notice($message, array $context = array())
    {
        // TODO: Implement notice() method.
    }

    /**
     * {@inheritDoc}
     */
    public function info($message, array $context = array())
    {
        // TODO: Implement info() method.
    }

    /**
     * {@inheritDoc}
     */
    public function debug($message, array $context = array())
    {
        // TODO: Implement debug() method.
    }

    /**
     * {@inheritDoc}
     */
    public function log($level, $message, array $context = array())
    {
        // TODO: Implement log() method.
    }
}