<?php

namespace Jadob\CommandBus\Strategy;

/**
 * This strategy assumes that Handler class implements HasCommandGetterInterface. A lazy one
 * @package Jadob\CommandBus\Strategy
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class HandlerHasCommandGetterStrategy implements InvokingStrategyInterface
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