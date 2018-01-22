<?php

namespace Slice\Security\Auth;


use Slice\Security\Auth\Provider\UserProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthenticationManager
 * @package Slice\Security\Auth
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

    protected $error;

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
            || !$request->request->has('_username') //has not username field
            || !$request->request->has('_password') //has not password field
            || $this->userStorage->getUser() !== null //user is logged in
        ) {
            return;
        }

        $userFromProvider = (array)$this->provider->loadUserByUsername($request->request->get('_username'));

        if ($userFromProvider === null || count($userFromProvider) === 0) {
            $this->error = 'auth.user.not.found';
            return;
        }

        $plainPassword = $request->request->get('_password');

        if (password_verify($plainPassword, $userFromProvider['password'])) {
            $this->userStorage->setUserState($userFromProvider);
            return;
        }

        $this->lastUsername = $request->request->get('_username');
        $this->error = 'auth.invalid.password';
        return;
    }

    public function updateUserFromStorage()
    {
        $username = $this->getUserStorage()->getUser()['username'];
        $data = $this->provider->loadUserByUsername($username);
        $this->getUserStorage()->setUserState((array)$data);
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
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     * @return AuthenticationManager
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastUsername()
    {
        return $this->lastUsername;
    }

    /**
     * @param mixed $lastUsername
     * @return AuthenticationManager
     */
    public function setLastUsername($lastUsername)
    {
        $this->lastUsername = $lastUsername;
        return $this;
    }


}