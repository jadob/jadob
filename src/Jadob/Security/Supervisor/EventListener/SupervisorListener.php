<?php

declare(strict_types=1);

namespace Jadob\Security\Supervisor\EventListener;

use Jadob\Core\Event\BeforeControllerEvent;
use Jadob\Security\Auth\UserStorage;
use Jadob\Security\Exception\UserNotFoundException;
use Jadob\Security\Supervisor\RequestSupervisor\RequestSupervisorInterface;
use Jadob\Security\Supervisor\Supervisor;
use Psr\EventDispatcher\ListenerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function get_class;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class SupervisorListener implements ListenerProviderInterface
{

    /**
     * @var Supervisor
     */
    protected Supervisor $supervisor;

    /**
     * @var UserStorage
     */
    protected UserStorage $userStorage;

    /**
     * SupervisorListener constructor.
     *
     * @param Supervisor $supervisor
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

        //Assign current provider to context
        $event->getContext()->setSupervisor($requestSupervisor);


        //At first, handle stateless
        if ($requestSupervisor->isStateless()) {
            $response = $this->handleStatelessRequest($event->getRequest(), $requestSupervisor);

            if ($response !== null) {
                $event->setResponse($response);
            }
            return $event;
        }

        $response = $this->handleNonStatelessRequest($event->getRequest(), $requestSupervisor);

        if ($response !== null) {
            $event->setResponse($response);
        }
        return $event;

    }


    /**
     * @param Request $request
     * @param RequestSupervisorInterface $supervisor
     * @return Response|null
     */
    protected function handleStatelessRequest(Request $request, RequestSupervisorInterface $supervisor): ?Response
    {
        $credentials = $supervisor->extractCredentialsFromRequest($request);

        //break if no credentials found
        if ($credentials === null || $credentials === false) {
            //@TODO add exception message
            throw new UserNotFoundException();
        }

        $userProvider = $this->supervisor->getUserProviderForSupervisor($supervisor);
        $user = $supervisor->getIdentityFromProvider($credentials, $userProvider);

        if ($user === null) {
            //@TODO add exception message
            throw new UserNotFoundException();
        }

        if (!$supervisor->verifyIdentity($user, $credentials)) {
            //@TODO create new exception for this
            throw new UserNotFoundException();
        }


        $this->userStorage->setCurrentProvider(get_class($supervisor));
        $this->userStorage->setUser($user, get_class($supervisor));
        return $supervisor->handleAuthenticationSuccess($request, $user);
    }

    protected function handleNonStatelessRequest(Request $request, RequestSupervisorInterface $supervisor): ?Response
    {
        //1. Check if this is an authentication attempt:
        if ($supervisor->isAuthenticationRequest($request)) {
            //2. Handle Authentication
            $credentials = $supervisor->extractCredentialsFromRequest($request);

        }

        /**
         * Gets User from session storage.
         */
        $userFromStorage = $this->userStorage->getUser(get_class($supervisor));

        /**
         * Case #1: User is logged in, nothing to do
         * Allow request to continue as everything is ok
         */
        if ($userFromStorage !== null) {
            return null;
        }

        $anonymousRequestAllowed = $supervisor->isAnonymousRequestAllowed($request);

        /**
         * Case #2: User is not authenticated, but supervisor allows these request to continue without authentication
         */
        if ($userFromStorage === null && $anonymousRequestAllowed) {
            return null;
        }

        /**
         * Case #3: User is not authenticated, but authentication is required
         */
        if ($userFromStorage === null && !$anonymousRequestAllowed) {
            return $supervisor->handleUnauthenticated();
        }


        //3. User is not logged in, but supervisor allows unauthenticated user to enter
        //4. User is not logged in and supervisor wants user to be authenticated
        //5. User is logged in, there is nothing to do
    }

}