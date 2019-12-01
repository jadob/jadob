<?php

declare(strict_types=1);

namespace Jadob\Bridge\Monolog;

use Monolog\Handler\HandlerInterface;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
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

    public function __construct(string $channel, bool $deferred = false)
    {
        $this->channel = $channel;
        $this->deferred = $deferred;
    }

    public function withHandler(HandlerInterface $handler)
    {

    }
    public function addStream(string $stream, int $logLevel): LoggerFactory
    {
        $this->streams[] = [
            'stream' => $stream,
            'logLevel' => $logLevel
        ];

        return $this;
    }

    public function create()
    {

    }
}