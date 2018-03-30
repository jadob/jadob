<?php

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\Exception\UserNotFoundException;
use Jadob\Security\Auth\Provider\UserProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthenticationManager
 * @package Jadob\Security\Auth
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class AuthenticationManager
{
    /**
     * @var UserStorage
     */
    protected $userStorage;

    /**
     * @var UserProviderInterface
     */
    protected $provider;

    /**
     * @var string
     */
    protected $error;

    /**
     * @var string
     */
    protected $lastUsername;

    /**
     * AuthenticationManager constructor.
     * @param UserStorage $userStorage
     * @param UserProviderInterface $provider
     */
    public function __construct(UserStorage $userStorage, UserProviderInterface $provider)
    {
        $this->userStorage = $userStorage;
        $this->provider = $provider;
    }

    public function handleRequest(Request $request)
    {
        if (
            $request->getMethod() !== 'POST' // is not post request
            || !$request->request->has('_auth') //has no _auth array passed
            || $this->userStorage->getUser() !== null //user is logged in
        ) {

            return false;
        }

        try {
            $userFromProvider = (array)$this->provider->loadUserByUsername($request->request->get('_auth')['_username']);
        } catch (UserNotFoundException $e) {
            $userFromProvider = null;
        }


        if ($userFromProvider === null || \count($userFromProvider) === 0) {
            $this->error = 'auth.user.not.found';
            return false;
        }

        $plainPassword = $request->request->get('_auth')['_password'];

        if (password_verify($plainPassword, $userFromProvider['password'])) {
            $this->userStorage->setUserState($userFromProvider);
            return true;
        }

        $this->lastUsername = $request->request->get('_username');
        $this->error = 'auth.invalid.password';
        return false;
    }

    public function updateUserFromStorage()
    {
        $username = $this->getUserStorage()->getUser()['username'];
        $data = $this->provider->loadUserByUsername($username);
        $this->getUserStorage()->setUserState((array)$data);
    }

    /**
     * Logout user and removes storage keys.
     */
    public function logout()
    {
        $this->getUserStorage()->removeUserFromStorage();
    }

    /**
     * @return UserStorage
     */
    public function getUserStorage(): UserStorage
    {
        return $this->userStorage;
    }

    /**
     * @param UserStorage $userStorage
     * @return AuthenticationManager
     */
    public function setUserStorage(UserStorage $userStorage): AuthenticationManager
    {
        $this->userStorage = $userStorage;
        return $this;
    }

    /**
     * @return UserProviderInterface
     */
    public function getProvider(): UserProviderInterface
    {
        return $this->provider;
    }

    /**
     * @param UserProviderInterface $provider
     * @return AuthenticationManager
     */
    public function setProvider(UserProviderInterface $provider): AuthenticationManager
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     * @return AuthenticationManager
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastUsername()
    {
        return $this->lastUsername;
    }

    /**
     * @param string $lastUsername
     * @return AuthenticationManager
     */
    public function setLastUsername($lastUsername)
    {
        $this->lastUsername = $lastUsername;
        return $this;
    }

}