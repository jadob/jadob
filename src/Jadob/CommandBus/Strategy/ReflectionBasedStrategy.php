<?php

namespace Jadob\CommandBus\Strategy;

/**
 * Finds handler by using Reflection* classes.
 * @package Jadob\ServiceBus\Strategy
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ReflectionBasedStrategy implements InvokingStrategyInterface
{

    /**
     * Send all handlers to strategy to feed collection.
     * @param array $handlers
     */
    public function setHandlers($handlers)
    {
        // TODO: Implement setHandlers() method.
    }
}