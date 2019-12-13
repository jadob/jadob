<?php

namespace Jadob\Bridge\Doctrine\DBAL\Logger;

use Doctrine\DBAL\Logging\SQLLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Psr3QueryLogger
 *
 * @package Jadob\Bridge\Doctrine\DBAL\Logger
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Psr3QueryLogger implements SQLLogger
{

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var array
     */
    protected $recentQuery;

    /**
     * Psr3QueryLogger constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {

        $this->logger = $logger;
    }

    /**
     * Logs a SQL statement somewhere.
     *
     * @param string              $sql    The SQL to be executed.
     * @param mixed[]|null        $params The SQL parameters.
     * @param int[]|string[]|null $types  The SQL parameter types.
     *
     * @return void
     */
    public function startQuery($sql, ?array $params = null, ?array $types = null): void
    {
        $this->recentQuery = [
            'sql' => $sql,
            'params' => $params,
            'types' => $types,
            'start_time' => microtime(true)
        ];
    }

    /**
     * Marks the last started query as stopped. This can be used for timing of queries.
     *
     * @return void
     */
    public function stopQuery(): void
    {
        if (empty($this->recentQuery)) {
            return;
        }

        $message = $this->recentQuery['sql'];
        unset($this->recentQuery['sql']);
        $this->recentQuery['finish_time'] = microtime(true);
        $this->logger->info($message, $this->recentQuery);
        $this->recentQuery = [];
    }
}