<?php
declare(strict_types=1);

namespace Jadob\Security\Supervisor\EventListener;

use Jadob\Core\Event\BeforeControllerEvent;
use Jadob\EventDispatcher\ListenerProviderPriorityInterface;
use Jadob\Security\Supervisor\RequestAttribute;
use Psr\EventDispatcher\ListenerProviderInterface;

class AuthorizerListener implements ListenerProviderInterface, ListenerProviderPriorityInterface
{
    public function getListenersForEvent(object $event): iterable
    {
        if ($event instanceof BeforeControllerEvent) {
            return [
                [$this, 'handleAuthorization']
            ];
        }

        return [];
    }

    public function getListenerPriorityForEvent(object $event): int
    {
        return 120; //DEFAULT_LISTENER_PRIORITY + 20 (Authorizer must be dispatched AFTER Authenticator, which has 110)
    }

    public function handleAuthorization(BeforeControllerEvent $event)
    {
        $context = $event->getContext();

        if(
            $context->getUser() === null
            && $context->getRequest()->attributes->get(RequestAttribute::SUPERVISOR_ANONYMOUS_ALLOWED) === true
        ) {
            return;
        }


    }
}