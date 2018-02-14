<?php

namespace Jadob\Security\Auth;

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
    const USER_SESSION_KEY = '_logged_user';

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var User|null
     */
    protected $userObject;

    /**
     * UserStorage constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        if($this->userObject === null && $this->session->has(self::USER_SESSION_KEY)) {
            $this->userObject = new User($this->session->get(self::USER_SESSION_KEY));
        }

        return $this->userObject;
    }

    /**
     * @param array $user
     */
    public function setUserState($user)
    {
        $this->session->set(self::USER_SESSION_KEY, $user);
    }

    /**
     * Removes user.
     */
    public function removeUserFromStorage()
    {
        $this->session->remove(self::USER_SESSION_KEY);
    }

}