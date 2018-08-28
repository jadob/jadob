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
     * @var string
     */
    protected $currentAuthRuleName;

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
        if($this->userObject === null && $this->session->has($this->getSessionKey())) {
            $this->userObject = \unserialize($this->session->get($this->getSessionKey()));
        }

        return $this->userObject;
    }

    /**
     * @param UserInterface $user
     */
    public function setUserState($user)
    {
        $this->session->set($this->getSessionKey(), serialize($user));
    }

    /**
     * Removes user.
     */
    public function removeUserFromStorage()
    {
        $this->session->remove($this->getSessionKey());
    }


    public function getSessionKey()
    {
        return $this->currentAuthRuleName.'-'.self::USER_SESSION_KEY;
    }

    /**
     * @return string
     */
    public function getCurrentAuthRuleName(): string
    {
        return $this->currentAuthRuleName;
    }

    /**
     * @param string $currentAuthRuleName
     * @return UserStorage
     */
    public function setCurrentAuthRuleName(string $currentAuthRuleName): UserStorage
    {
        $this->currentAuthRuleName = $currentAuthRuleName;
        return $this;
    }

}