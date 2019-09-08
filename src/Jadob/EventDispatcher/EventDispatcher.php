<?php

namespace Jadob\EventDispatcher;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * @see https://www.php-fig.org/psr/psr-14/
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class EventDispatcher implements EventDispatcherInterface
{

    /**
     * @var ListenerProviderInterface[]
     */
    protected $listeners = [];

    /**
     * Provide all relevant listeners with an event to process.
     *
     * @param object $event
     *   The object to process.
     *
     * @return object
     *   The Event that was passed, now modified by listeners.
     * @see https://www.php-fig.org/psr/psr-14/#dispatcher
     */
    public function dispatch(object $event)
    {
        // TODO: Implement dispatch() method.
    }


    /**
     * @param ListenerProviderInterface $provider
     * @return $this
     */
    public function addListener(ListenerProviderInterface $provider): EventDispatcher
    {
        $this->listeners[] = $provider;
        return $this;
    }
}