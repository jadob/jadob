<?php

namespace Jadob\Security\Supervisor\EventListener;

use Jadob\Core\Event\BeforeControllerEvent;
use Jadob\Security\Supervisor\Supervisor;
use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class SupervisorListener implements ListenerProviderInterface
{

    /**
     * @var Supervisor
     */
    protected $supervisor;

    /**
     * SupervisorListener constructor.
     * @param Supervisor $supervisor
     */
    public function __construct(Supervisor $supervisor)
    {
        $this->supervisor = $supervisor;
    }

    /**
     * {@inheritdoc}
     */
    public function getListenersForEvent(object $event): iterable
    {
        if ($event instanceof BeforeControllerEvent) {
            return [
                [$this, 'onBeforeController']
            ];
        }

        return [];
    }

    public function onBeforeController(BeforeControllerEvent $event): BeforeControllerEvent
    {
        $supervisor = $this->supervisor->matchRequestSupervisor($event->getRequest());
        if($supervisor === null && $this->supervisor->isBlockingUnsecuredRequests()) {
            //@TODO emit exception
        }

        //1. Check if this is an authentication attempt:
        if($supervisor->isAuthenticationRequest($event->getRequest())) {
            //2. Handle Authentication
            $credentials = $supervisor->extractCredentialsFromRequest($event->getRequest());



            return;
        }

        //3. User is not logged in, but supervisor allows unauthenticated user to enter
        //4. User is not logged in and supervisor wants user to be authenticated
        //5. User is logged in, there is nothing to do

    }

}