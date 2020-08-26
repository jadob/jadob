<?php

declare(strict_types=1);

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * TODO: this one maybe should be called IdentityStorage
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
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
    protected ?SessionInterface $session = null;

    /**
     * @var string|null
     */
    protected ?string $currentProvider = null;

    /**
     * @param SessionInterface|null $session
     */
    public function __construct(?SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @param SessionInterface $session
     */
    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    /**
     * When in multiple dispatch cycle, sessions will be assigned automatically in BeforeControllerEvent,
     * And removed in AfterControllerEvent. This method is used to remove current session and matched supervisor from
     * class to make sure that nothing will be passed to another request.
     */
    public function removeCurrentRequestData()
    {
        $this->session = null;
        $this->currentProvider = null;
    }

    /**
     * @param null|string $provider
     * @return UserInterface
     */
    public function getUser(?string $provider = null): ?UserInterface
    {
        //@TODO: add special exception class for Jadob/Security/Auth things
        if ($this->session === null) {
            throw new \RuntimeException('A session have been not passed to UserStorage object.');
        }

        if ($provider === null) {
            $provider = $this->currentProvider;
        }

        $userFromSession = $this->session->get(self::USER_SESSION_KEY . $provider);
        if ($userFromSession === null) {
            return null;
        }

        $user = unserialize($userFromSession);
        if ($user !== false) {
            return $user;
        }

        return null;
    }

    /**
     * @TODO   there should be some parameter for defining stateless things
     * @param UserInterface $user
     * @param null|string $provider
     * @return UserStorage
     */
    public function setUser(UserInterface $user, ?string $provider = null): UserStorage
    {
        if ($provider === null) {
            $provider = $this->currentProvider;
        }

        $this->session->set(self::USER_SESSION_KEY . $provider, serialize($user));
        return $this;
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