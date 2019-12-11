<?php

declare(strict_types=1);

namespace Jadob\EventDispatcher;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\EventDispatcher\StoppableEventInterface;
use Psr\Log\LoggerInterface;
use function get_class;
use function microtime;
use function spl_object_hash;

/**
 * @see https://www.php-fig.org/psr/psr-14/
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
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
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * EventDispatcher constructor.
     * @param LoggerInterface|null $logger
     */
    public function __construct(?LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     * @see https://www.php-fig.org/psr/psr-14/#dispatcher
     */
    public function dispatch(object $event)
    {
        $className = get_class($event);
        $this->timestamps[] = new Timestamp(
            $className,
            microtime(true),
            spl_object_hash($event)
        );

        $handlersCount = 0;
        foreach ($this->listeners as $listener) {
            $eventsFromListener = $listener->getListenersForEvent($event);

            foreach ($eventsFromListener as $singleListener) {
                $singleListener($event);
                $handlersCount++;

                if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
                    $this->log(
                        'Event ' . $className . ' propagation has been stopped by ' . get_class($singleListener)
                        . ' listener. Event has been consumed by ' . $handlersCount . ' listeners.'
                    );
                    return $event;
                }
            }
        }

        $this->log('Event ' . $className . ' has been consumed by ' . $handlersCount . ' listeners without interrupting.');
        return $event;
    }

    /**
     * @param string $message
     * @param array $context
     */
    private function log(string $message, array $context = []): void
    {
        if ($this->logger === null) {
            return;
        }

        $this->logger->info($message, $context);
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