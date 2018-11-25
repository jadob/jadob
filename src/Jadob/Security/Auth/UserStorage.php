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
    private const USER_SESSION_KEY = '_jdb.user';

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * UserStorage constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {

        if ($this->user === null) {
            $userFromSession = unserialize($this->session->get(self::USER_SESSION_KEY));

            if ($userFromSession !== false) {
                $this->user = $userFromSession;
            }
        }
        return $this->user;
    }

    /**
     * @param UserInterface $user
     * @return UserStorage
     */
    public function setUser(UserInterface $user): UserStorage
    {
        $this->session->set(self::USER_SESSION_KEY, serialize($user));
        $this->user = $user;
        return $this;
    }


}