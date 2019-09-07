<?php

namespace Jadob\Security\Guard;

use Jadob\Security\Auth\User\UserInterface;
use Jadob\Security\Auth\UserProviderInterface;
use Jadob\Security\Auth\UserStorage;
use Symfony\Component\HttpFoundation\Request;

/**
 * @deprecated
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
     * @var string|null
     */
    protected $currentGuardName;

    /**
     * @var string[]
     */
    protected $excludedPaths = [];

    /**
     * Guard constructor.
     * @param UserStorage $userStorage
     * @param array $excludedPaths
     */
    public function __construct(UserStorage $userStorage, array $excludedPaths = [])
    {
        $this->userStorage = $userStorage;
        $this->excludedPaths = $excludedPaths;
    }

    /**
     * @param GuardAuthenticatorInterface $authenticator
     * @param string|null $name
     * @return Guard
     */
    public function addGuard(GuardAuthenticatorInterface $authenticator, string $name)
    {
        $this->guards[$name] = $authenticator;
        return $this;
    }

    /**
     * @param UserProviderInterface $userProvider
     * @param string $name
     * @return $this
     */
    public function addUserProvider(UserProviderInterface $userProvider, string $name)
    {
        $this->userProviders[$name] = $userProvider;
        return $this;
    }

    /**
     * @param Request $request
     * @return GuardAuthenticatorInterface|null
     */
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

                $this->userStorage->setCurrentProvider($guardKey);
                $this->setCurrentGuardName($guardKey);

                if ($this->userStorage->getUser() !== null) {
                    return null;
                }

                $credentials = $guard->extractCredentialsFromRequest($request);

                if ($credentials === null) {
                    return $guard->createNotLoggedInResponse();
                }

                $user = $guard->getUserFromProvider($credentials, $this->userProviders[$guardKey]);

                if ($user instanceof UserInterface && $guard->verifyCredentials($credentials, $user)) {
                    $this->userStorage->setUser($user, $guardKey);

                    return $guard->createSuccessAuthenticationResponse($user);
                }

                return $guard->createInvalidCredentialsResponse();
            }
        }

        return null;
    }

    /**
     * Alias for isPathExcluded.
     * @param Request $request
     * @return bool
     */
    public function isRequestExcluded(Request $request): bool
    {
        return $this->isPathExcluded($request->getPathInfo());
    }

    /**
     * @param string $path
     * @return bool
     */
    public function isPathExcluded(string $path): bool
    {
        foreach ($this->excludedPaths as $excludedPathPattern) {

            $excludedPathPattern = '@' . $excludedPathPattern . '@';

            if (preg_match($excludedPathPattern, $path) !== 0) {
                return true;
            }
        }

        return false;
    }


    /**
     * @return null|string
     */
    public function getCurrentGuardName(): ?string
    {
        return $this->currentGuardName;
    }

    /**
     * @param null|string $currentGuardName
     * @return Guard
     */
    public function setCurrentGuardName(?string $currentGuardName): Guard
    {
        $this->currentGuardName = $currentGuardName;
        return $this;
    }

    /**
     * @param $name
     * @return GuardAuthenticatorInterface
     */
    public function getGuardByName(string $name)
    {
        return $this->guards[$name];
    }

    /**
     * @param string $name
     * @return UserProviderInterface
     */
    public function getProviderByName(string $name)
    {
        return $this->userProviders[$name];
    }


}