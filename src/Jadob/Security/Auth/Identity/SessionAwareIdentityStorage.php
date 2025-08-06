<?php

declare(strict_types=1);

namespace Jadob\Security\Auth\Identity;

use Jadob\Security\Auth\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @deprecated
 * @internal
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class SessionAwareIdentityStorage implements IdentityStorageInterface
{
    private const string USER_SESSION_KEY = '_jdb.user.';

    public function __construct(
        protected SessionInterface $session
    ) {
    }

    /**
     * @param string $authenticatorName
     * @return UserInterface|null
     */
    public function getUser(
        string $authenticatorName
    ): ?UserInterface {
        /** @var string|null $userFromSession */
        $userFromSession = $this->session->get($this->buildSessionKey($authenticatorName));
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
     * @param UserInterface $user
     * @param string $authenticatorName
     * @return void
     */
    public function setUser(
        UserInterface $user,
        string $authenticatorName
    ): void {
        $this->session->set(
            $this->buildSessionKey($authenticatorName),
            serialize($user)
        );
    }

    protected function buildSessionKey(string $authenticatorName): string
    {
        return sprintf('%s/%s', self::USER_SESSION_KEY, $authenticatorName);
    }
}