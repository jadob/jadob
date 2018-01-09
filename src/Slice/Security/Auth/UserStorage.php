<?php

namespace Slice\Security\Auth;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UserStorage
{
    const USER_SESSION_KEY = '_logged_user';

    protected $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function getUser()
    {
        return $this->session->get(self::USER_SESSION_KEY);
    }

    public function setUserState($user)
    {
        $this->session->set(self::USER_SESSION_KEY, $user);
    }
    
    
}