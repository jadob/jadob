<?php

namespace Jadob\Security\Guard;

use Jadob\Security\Auth\User\UserInterface;
use Jadob\Security\Auth\UserProviderInterface;
use Jadob\Security\Auth\UserStorage;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GuardDispatcher
 * @package Jadob\Security\Guard
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Guard
{
    /**
     * @var GuardAuthenticatorInterface[]
     */
    protected $guards = [];

    /**
     * @var UserProviderInterface[]
     */
    protected $userProviders = [];

    /**
     * @var UserStorage
     */
    protected $userStorage;


    /**
     * Guard constructor.
     * @param UserStorage $userStorage
     */
    public function __construct(UserStorage $userStorage)
    {
        $this->userStorage = $userStorage;
    }

    /**
     * @param GuardAuthenticatorInterface $authenticator
     * @param string|null $name
     * @return Guard
     */
    public function addGuard(GuardAuthenticatorInterface $authenticator, $name)
    {
        $this->guards[$name] = $authenticator;
        return $this;
    }

    public function addUserProvider(UserProviderInterface $userProvider, $name)
    {
        $this->userProviders[$name] = $userProvider;
        return $this;
    }

    public function matchRule(Request $request)
    {
        foreach ($this->guards as $guard) {
            if ($guard->requestMatches($request)) {
                return $guard;
            }
        }

        return null;
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function execute(Request $request)
    {
        foreach ($this->guards as $guardKey => $guard) {
            if ($guard->requestMatches($request)) {

                if ($this->userStorage->getUser() !== null) {
                    return null;
                }

                $credentials = $guard->extractCredentialsFromRequest($request);

                if ($credentials === null) {
                    return $guard->createNotLoggedInResponse();
                }

                $user = $guard->getUserFromProvider($credentials);

                if ($user instanceof UserInterface && $guard->verifyCredentials($credentials, $user)) {
                    $this->userStorage->setUser($user, $guardKey);

                    return $guard->createSuccessAuthenticationResponse();
                }

                return $guard->createInvalidCredentialsResponse();
            }
        }

        return null;
    }

}