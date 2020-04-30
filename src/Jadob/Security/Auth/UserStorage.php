<?php

declare(strict_types=1);

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * TODO: this one maybe should be called IdentityStorage
 * Class UserStorage
 *
 * @package Jadob\Security\Auth
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
    protected SessionInterface $session;

    /**
     * @var string|null
     */
    protected ?string $currentProvider;

    /**
     * UserStorage constructor.
     *
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
    public function getUser(?string $provider = null): ?UserInterface
    {

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