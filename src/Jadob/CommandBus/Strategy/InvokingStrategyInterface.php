<?php

namespace Jadob\CommandBus\Strategy;

/**
 * This interface should be implemented in all strategies that can be used in ServiceBus class.
 * @package Jadob\ServiceBus\Strategy
 * @author pizzaminded <miki@appvende.net>
 */
interface InvokingStrategyInterface
{
    /**
     * Send all handlers to strategy to feed collection.
     * @param array $handlers
     */
    public function setHandlers($handlers);
}