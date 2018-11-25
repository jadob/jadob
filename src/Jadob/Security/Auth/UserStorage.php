<?php

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class UserStorage
 * @package Jadob\Security\Auth
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class UserStorage
{

    /**
     * @var string
     */
    private const USER_SESSION_KEY = '_jdb.user.';

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var string
     */
    protected $currentProvider;

    /**
     * UserStorage constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @param null|string $provider
     * @return UserInterface
     */
    public function getUser($provider = null)
    {


        if ($provider === null) {
            $provider = $this->currentProvider;
        }

        if ($this->user === null) {
            $userFromSession = unserialize($this->session->get(self::USER_SESSION_KEY . $provider));

            if ($userFromSession !== false) {
                $this->user = $userFromSession;
            }
        }
        return $this->user;
    }

    /**
     * @param UserInterface $user
     * @param null|string $provider
     * @return UserStorage
     */
    public function setUser(UserInterface $user, $provider = null): UserStorage
    {
        if ($provider === null) {
            $provider = $this->currentProvider;
        }


        $this->session->set(self::USER_SESSION_KEY . $provider, serialize($user));
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentProvider()
    {
        return $this->currentProvider;
    }

    /**
     * @param string $currentProvider
     * @return UserStorage
     */
    public function setCurrentProvider($currentProvider): UserStorage
    {
        $this->currentProvider = $currentProvider;
        return $this;
    }


}