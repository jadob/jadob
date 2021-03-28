<?php

declare(strict_types=1);

namespace Jadob\Security\Supervisor\EventListener;

use Jadob\Core\Event\BeforeControllerEvent;
use Jadob\Core\RequestContext;
use Jadob\EventDispatcher\EventDispatcher;
use Jadob\EventDispatcher\ListenerProviderPriorityInterface;
use Jadob\Security\Auth\Exception\AuthenticationException;
use Jadob\Security\Auth\Exception\InvalidCredentialsException;
use Jadob\Security\Auth\Exception\UserNotFoundException;
use Jadob\Security\Auth\IdentityStorage;
use Jadob\Security\Supervisor\RequestAttribute;
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
class AuthenticatorListener implements ListenerProviderInterface, ListenerProviderPriorityInterface
{

    /**
     * @var Supervisor
     */
    protected Supervisor $supervisor;

    /**
     * @var IdentityStorage
     */
    protected IdentityStorage $identityStorage;

    /**
     * @param Supervisor $supervisor
     * @param IdentityStorage $identityStorage
     */
    public function __construct(Supervisor $supervisor, IdentityStorage $identityStorage)
    {
        $this->supervisor = $supervisor;
        $this->identityStorage = $identityStorage;
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

        /**
         * There is nothing to do when there is no supervisor available
         */
        if ($requestSupervisor === null) {
            return $event;
        }


        //At first, handle stateless
        if ($requestSupervisor->isStateless()) {
            $response = $this->handleStatelessRequest($event->getRequest(), $requestSupervisor);

            if ($response !== null) {
                $event->setResponse($response);
            }
            return $event;
        }

        $response = $this->handleNonStatelessRequest($event->getContext(), $requestSupervisor);

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
        try {
            $credentials = $supervisor->extractCredentialsFromRequest($request);

            if ($credentials === null || $credentials === false || (is_countable($credentials) && count($credentials) === 0)) {
                throw UserNotFoundException::emptyCredentials();
            }

            $userProvider = $this->supervisor->getUserProviderForSupervisor($supervisor);
            $user = $supervisor->getIdentityFromProvider($credentials, $userProvider);

            if ($user === null) {
                throw UserNotFoundException::emptyCredentials();
            }

            if (!$supervisor->verifyIdentity($user, $credentials)) {
                throw InvalidCredentialsException::invalidCredentials();
            }
        } catch (AuthenticationException $exception) {
            return $supervisor->handleAuthenticationFailure($exception, $request);
        }

        $this->identityStorage->setUser($user, $request->getSession(), get_class($supervisor));
        return $supervisor->handleAuthenticationSuccess($request, $user);
    }

    protected function handleNonStatelessRequest(RequestContext $context, RequestSupervisorInterface $supervisor): ?Response
    {
        $request = $context->getRequest();

        //1. Check if this is an authentication attempt:
        if ($supervisor->isAuthenticationRequest($request)) {
            try {
                //2. Handle Authentication
                $credentials = $supervisor->extractCredentialsFromRequest($request);
                if ($credentials === null || $credentials === false || count($credentials) === 0) {
                    throw UserNotFoundException::emptyCredentials();
                }

                //Get user
                $user = $supervisor->getIdentityFromProvider(
                    $credentials,
                    $this->supervisor->getUserProviderForSupervisor($supervisor)
                );

                if ($user === null) {
                    throw UserNotFoundException::userNotFound();
                }

                //verify user
                $verified = $supervisor->verifyIdentity($user, $credentials);
                if ($verified === false) {
                    throw InvalidCredentialsException::invalidCredentials();
                }

            } catch (AuthenticationException $exception) {
                return $supervisor->handleAuthenticationFailure($exception, $request);
            }

            $this->identityStorage->setUser($user, $request->getSession(), get_class($supervisor));
            return $supervisor->handleAuthenticationSuccess($request, $user);
        }

        $userFromStorage = $this->identityStorage->getUser($request->getSession(), get_class($supervisor));
        $context->setUser($userFromStorage);

        /**
         * Case #1: User is logged in, nothing to do
         * Allow request to continue as everything is ok
         */
        if ($userFromStorage !== null) {
            return null;
        }

        $anonymousRequestAllowed = $supervisor->isAnonymousRequestAllowed($request);
        $request->attributes->set(RequestAttribute::SUPERVISOR_ANONYMOUS_ALLOWED, $anonymousRequestAllowed);

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


        return null;
        //3. User is not logged in, but supervisor allows unauthenticated user to enter
        //4. User is not logged in and supervisor wants user to be authenticated
        //5. User is logged in, there is nothing to do
    }

    public function getListenerPriorityForEvent(object $event): int
    {
        return 110; // DEFAULT_LISTENER_PRIORITY + 10
    }
}