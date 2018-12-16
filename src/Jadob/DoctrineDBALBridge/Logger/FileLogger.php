<?php

namespace Jadob\DoctrineDBALBridge\Logger;

use Doctrine\DBAL\Logging\SQLLogger;

/**
 * Tracks all queries and saves them in file.
 * @package Jadob\DoctrineDBALBridge\Logger
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FileLogger implements SQLLogger
{

    /**
     * @var string
     */
    protected $filePath;

    /**
     * FileLogger constructor.
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;

    }

    /**
     * Logs a SQL statement somewhere.
     *
     * @param string $sql The SQL to be executed.
     * @param mixed[]|null $params The SQL parameters.
     * @param int[]|string[]|null $types The SQL parameter types.
     *
     * @return void
     */
    public function startQuery($sql, ?array $params = null, ?array $types = null)
    {
        // TODO: Implement startQuery() method.
    }

    /**
     * Marks the last started query as stopped. This can be used for timing of queries.
     *
     * @return void
     */
    public function stopQuery()
    {
        // TODO: Implement stopQuery() method.
    }
}