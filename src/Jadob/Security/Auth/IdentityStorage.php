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
class IdentityStorage
{
    /**
     * @var string
     */
    private const USER_SESSION_KEY = '_jdb.user.';

    /**
     * @param SessionInterface $session
     * @param null|string $provider
     * @return UserInterface
     */
    public function getUser(SessionInterface $session, ?string $provider = null): ?UserInterface
    {
        $userFromSession = $session->get($this->buildSessionKey($provider));
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
     * @param SessionInterface $session
     * @param null|string $provider
     * @return IdentityStorage
     */
    public function setUser(UserInterface $user, SessionInterface $session, ?string $provider = null): IdentityStorage
    {
        $session->set(
            $this->buildSessionKey($provider),
            serialize($user)
        );

        return $this;
    }

    /**
     * @param string $provider FQCN of provider class
     * @return string
     */
    protected function buildSessionKey($provider): string
    {
        return sprintf('%s/%s', self::USER_SESSION_KEY, $provider);
    }
}