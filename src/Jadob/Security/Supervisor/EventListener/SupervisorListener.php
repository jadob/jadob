<?php

namespace Jadob\Security\Supervisor\EventListener;

use Jadob\Core\Event\BeforeControllerEvent;
use Jadob\Security\Auth\UserStorage;
use Jadob\Security\Exception\UserNotFoundException;
use Jadob\Security\Supervisor\Supervisor;
use Psr\EventDispatcher\ListenerProviderInterface;
use function get_class;

/**
 * @author  pizzaminded <miki@appvende.net>
 * @license MIT
 */
class SupervisorListener implements ListenerProviderInterface
{

    /**
     * @var Supervisor
     */
    protected $supervisor;

    /**
     * @var UserStorage
     */
    protected $userStorage;

    /**
     * SupervisorListener constructor.
     *
     * @param Supervisor  $supervisor
     * @param UserStorage $userStorage
     */
    public function __construct(Supervisor $supervisor, UserStorage $userStorage)
    {
        $this->supervisor = $supervisor;
        $this->userStorage = $userStorage;
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
        $requestSupervisor = $this->supervisor->matchRequestSupervisor($event->getRequest());
        if ($requestSupervisor === null && $this->supervisor->isBlockingUnsecuredRequests()) {
            //@TODO emit exception
        }

        //At first, handle stateless
        if ($requestSupervisor->isStateless()) {
            $credentials = $requestSupervisor->extractCredentialsFromRequest($event->getRequest());

            //break if no credentials found
            if ($credentials === null || $credentials === false) {
                //@TODO add exception message
                throw new UserNotFoundException();
            }

            $userProvider = $this->supervisor->getUserProviderForSupervisor($requestSupervisor);
            $user = $requestSupervisor->getIdentityFromProvider($credentials, $userProvider);

            if($user === null) {
                //@TODO add exception message
                throw new UserNotFoundException();
            }

            if(!$requestSupervisor->verifyIdentity($user, $credentials)) {
                //@TODO create new exception for this
                throw new UserNotFoundException();
            }

            $this->userStorage->setCurrentProvider(get_class($requestSupervisor));
            $this->userStorage->setUser($user, get_class($requestSupervisor));
            $response = $requestSupervisor->handleAuthenticationSuccess($event->getRequest(), $user);

            if($response !== null) {
                $event->setResponse($response);
            }

            return $event;
        }

        //1. Check if this is an authentication attempt:
        if ($requestSupervisor->isAuthenticationRequest($event->getRequest())) {
            //2. Handle Authentication
            $credentials = $requestSupervisor->extractCredentialsFromRequest($event->getRequest());


            return $event;
        }

        //3. User is not logged in, but supervisor allows unauthenticated user to enter
        //4. User is not logged in and supervisor wants user to be authenticated
        //5. User is logged in, there is nothing to do

    }

}