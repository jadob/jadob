<?php

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\Exception\UserNotFoundException;
use Jadob\Security\Auth\Provider\UserProviderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AuthenticationManager
 * @TODO:
 * - add some user class, which will be serialized and stored in session
 * - allow developer to make his own User class
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
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * AuthenticationManager constructor.
     * @param UserStorage $userStorage
     * @param UserProviderInterface $provider
     * @param LoggerInterface $logger
     */
    public function __construct(
        UserStorage $userStorage,
        UserProviderInterface $provider,
        LoggerInterface $logger = null
    )
    {
        $this->userStorage = $userStorage;
        $this->provider = $provider;
        $this->logger = $logger;
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

        $username = $request->request->get('_auth')['_username'];

        try {
            /** @var UserInterface $userFromProvider */
            $userFromProvider = $this->provider->loadUserByUsername($username);
        } catch (UserNotFoundException $e) {
            $userFromProvider = null;
        }

        if ($userFromProvider === null || (\is_array($userFromProvider) && \count($userFromProvider) === 0)) {
            $this->error = 'auth.user.not.found';
            return false;
        }

        if (\is_array($userFromProvider)) {
            @trigger_error('User provider should return an object implementing UserInterface.', E_USER_DEPRECATED);
            $password = $userFromProvider['password'];
        } else {
            $password = $userFromProvider->getPassword();
        }


        $plainPassword = $request->request->get('_auth')['_password'];

        if (password_verify($plainPassword, $password)) {
            $this->userStorage->setUserState($userFromProvider);
            $this->addInfoLog('User ' . $username . ' has been logged from IP: ' . $request->getClientIp());
            return true;
        }

        $this->lastUsername = $request->request->get('_username');
        $this->error = 'auth.invalid.password';
        $this->addInfoLog('User ' . $username . ' were trying to log in from IP: ' . $request->getClientIp());
        return false;
    }

    public function updateUserFromStorage()
    {
        $username = $this->getUserStorage()->getUser()->getUsername();
        $data = $this->provider->loadUserByUsername($username);
        $this->getUserStorage()->setUserState($data);
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

    private function addInfoLog($message)
    {
        if ($this->logger === null) {
            return;
        }

        $this->logger->info('[Auth]: ' . $message);
    }


}