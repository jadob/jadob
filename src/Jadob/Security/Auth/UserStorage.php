<?php

namespace Jadob\Security\Auth;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @TODO: rewrite (firewall is deprecated, now guard is my best friend)
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
    protected const SESSION_KEY = '__jdb_user';

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var string|null
     */
    protected $firewallRuleName;

    /**
     * UserStorage constructor.
     * @param SessionInterface $session
     * @param string|null $firewallRuleName
     */
    public function __construct(SessionInterface $session, $firewallRuleName)
    {
        $this->session = $session;
        $this->firewallRuleName = $firewallRuleName;
    }

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }

    /**
     * @param SessionInterface $session
     * @return UserStorage
     */
    public function setSession(SessionInterface $session): UserStorage
    {
        $this->session = $session;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFirewallRuleName(): ?string
    {
        return $this->firewallRuleName;
    }

    /**
     * @param null|string $firewallRuleName
     * @return UserStorage
     */
    public function setFirewallRuleName(?string $firewallRuleName): UserStorage
    {
        $this->firewallRuleName = $firewallRuleName;
        return $this;
    }

    public function getUser($rule = null)
    {
        $key = self::SESSION_KEY . '.' . $this->getFirewallRuleName();

        if ($rule !== null) {
            $key = self::SESSION_KEY . '.' . $rule;
        }

        $sessionValue = $this->session->get($key, null);

        if ($sessionValue === null) {
            return null;
        }

        return \unserialize($sessionValue);

    }


}