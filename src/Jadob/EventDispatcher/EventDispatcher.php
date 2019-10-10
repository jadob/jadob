<?php

namespace Jadob\EventDispatcher;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;

/**
 * @TODO: enable timestamp collecting via constructor arguments?
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
     * @TODO maybe SplObjectStorage?
     * @var Timestamp[]
     */
    protected $timestamps = [];

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
        $this->timestamps[] = new Timestamp(
            \get_class($event),
            \microtime(true),
            \spl_object_hash($event)
        );

        foreach ($this->listeners as $listener) {
            $eventsFromListener = $listener->getListenersForEvent($event);
            foreach ($eventsFromListener as $singleListener) {
                $singleListener($event);

                if($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
                    //@TODO log that event dispatching has been interrupted
                    return $event;
                }
            }
        }

        return $event;
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