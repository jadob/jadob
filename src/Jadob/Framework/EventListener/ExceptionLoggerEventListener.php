<?php declare(strict_types=1);

namespace Jadob\Framework\EventListener;

use Jadob\Framework\Event\ExceptionEvent;
use Jadob\Framework\Logger\LoggerFactory;
use Psr\EventDispatcher\ListenerProviderInterface;

final readonly class ExceptionLoggerEventListener implements ListenerProviderInterface
{
    public function __construct(
        private LoggerFactory $loggerFactory,
    ) {
    }

    /**
     * @param object $event
     * @return iterable<object>
     */
    public function getListenersForEvent(object $event): iterable
    {
        if ($event instanceof ExceptionEvent) {
            return [
                $this->onExceptionEvent(...),
            ];
        }

        return [];
    }

    public function onExceptionEvent(ExceptionEvent $event): object
    {
        $this
            ->loggerFactory
            ->getDefaultErrorLogger()
            ->error($event->getException());
        
        return $event;
    }
}