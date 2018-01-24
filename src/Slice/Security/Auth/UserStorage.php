<?php

namespace Slice\Security\Auth;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class UserStorage
 * @package Slice\Security\Auth
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
     * UserStorage constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->session->get(self::USER_SESSION_KEY);
    }

    /**
     * @param $user
     */
    public function setUserState($user)
    {
        $this->session->set(self::USER_SESSION_KEY, $user);
    }

    public function removeUserFromStorage()
    {
        $this->session->remove(self::USER_SESSION_KEY);
    }

}