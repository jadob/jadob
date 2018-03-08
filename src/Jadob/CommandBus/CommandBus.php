<?php

namespace Jadob\CommandBus;

use Jadob\CommandBus\Exception\CommandBusException;
use Jadob\CommandBus\Strategy\InvokingStrategyInterface;
use Jadob\CommandBus\Strategy\ReflectionBasedStrategy;

/**
 * Class CommandBus
 * @package Jadob\CommandBus
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 * @internal as it not ready yet
 */
class CommandBus
{

    /**
     * @var InvokingStrategyInterface
     */
    protected $strategy;

    /**
     * CommandBus constructor.
     * @param $handlers
     * @param $strategy
     * @throws CommandBusException
     */
    public function __construct($handlers, $strategy)
    {
        if ($strategy === null) {
            $this->strategy = new ReflectionBasedStrategy();
        }

        if ($strategy !== null && !($strategy instanceof InvokingStrategyInterface)) {
            throw new CommandBusException('class "' . get_class($strategy) . '" could not be used as strategy as it does not implement InvokingStrategyInterface.');
        }
    }
}