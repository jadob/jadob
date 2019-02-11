<?php

namespace Jadob\Debug;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Logs all PHP related events/errors/exceptions to file.
 * @package Jadob\Debug
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ErrorLogger extends LogLevel implements LoggerInterface
{
    /**
     * @var string
     */
    protected $logFormat = '{date} [{level}]: {message}  (context: {context})';

    /**
     * @var string
     */
    protected $filePath;

    /**
     * Psr3FileLogger constructor.
     * @param $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * {@inheritdoc}
     */
    public function emergency($message, array $context = array())
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function alert($message, array $context = array())
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function critical($message, array $context = array())
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function error($message, array $context = array())
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function warning($message, array $context = array())
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function notice($message, array $context = array())
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function info($message, array $context = array())
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function debug($message, array $context = array())
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function log($level, $message, array $context = array())
    {
        $contextJson = \json_encode($context);

        $replaceParameters = [];

        $replaceParameters['{date}'] = \date('Y-m-d H:i:s');
        $replaceParameters['{level}'] = $level;
        $replaceParameters['{message}'] = $message;
        $replaceParameters['{context}'] = $contextJson;

        $message = \str_replace(\array_keys($replaceParameters), \array_values($replaceParameters), $this->logFormat);

        \file_put_contents($this->filePath, $message . PHP_EOL, \FILE_APPEND);
    }

}