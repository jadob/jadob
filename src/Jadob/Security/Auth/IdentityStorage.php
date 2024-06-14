<?php

declare(strict_types=1);

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class IdentityStorage
{

    public function __construct(
        protected SessionInterface $session,
        protected string $firewallName
    )
    {
    }

    /**
     * @var string
     */
    private const USER_SESSION_KEY = '_jdb.user.';

    /**
     * @param SessionInterface $session
     * @param null|string $provider
     * @return UserInterface
     */
    public function getUser(SessionInterface $session): ?UserInterface
    {
        /** @var string|null $userFromSession */
        $userFromSession = $session->get($this->buildSessionKey($provider));
        if ($userFromSession === null) {
            return null;
        }

        /** @var UserInterface|false $user */
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
    public function setUser(UserInterface $user): IdentityStorage
    {
        $this->session->set(
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