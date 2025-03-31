<?php

declare(strict_types=1);

namespace Jadob\Bridge\Monolog;

use Monolog\Handler\HandlerInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * @deprecated
 * Creates Logger instance.
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class LoggerFactory
{
    /**
     * @var string
     */
    protected $channel;

    /**
     * @var bool
     */
    protected $deferred;

    /**
     * @var array
     */
    protected $streams = [];

    /**
     * @var HandlerInterface[]
     */
    protected $handlers = [];

    /**
     * LoggerFactory constructor.
     *
     * @param string $channel
     * @param bool   $deferred
     */
    public function __construct(string $channel, bool $deferred = false)
    {
        $this->channel = $channel;
        $this->deferred = $deferred;
    }

    /**
     * @param  HandlerInterface $handler
     * @return $this
     */
    public function withHandler(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
        return $this;
    }

    /**
     * @return LoggerInterface
     */
    public function create(): LoggerInterface
    {
        return new Logger($this->channel, $this->handlers);
    }
}