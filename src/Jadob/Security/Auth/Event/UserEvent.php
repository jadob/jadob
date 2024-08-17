<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\Event;

use Jadob\Security\Auth\User\UserInterface;
use Jadob\Security\Supervisor\RequestSupervisor\RequestSupervisorInterface;

/**
 * @deprecated
 */
class UserEvent
{
    /**
     * User was just authenticated.
     */
    public const CONTEXT_AUTHENTICATED = 1;

    /**
     * User was authenticated few requests ago, and it is just taken from IdentityStorage.
     * Refresh or something may be required.
     */
    public const CONTEXT_TAKEN_FROM_SESSION = 2;
    protected RequestSupervisorInterface $requestSupervisor;

    public function __construct(
        protected UserInterface $user,
        protected int $context,
        RequestSupervisorInterface $requestSupervisor
    ) {
        $this->requestSupervisor = $requestSupervisor;
    }

    public function isAuthenticated(): bool
    {
        return $this->context === self::CONTEXT_AUTHENTICATED;
    }

    public function isTakenFromIdentityStorage(): bool
    {
        return $this->context === self::CONTEXT_TAKEN_FROM_SESSION;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getContext(): int
    {
        return $this->context;
    }

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user): void
    {
        $this->user = $user;
    }

    /**
     * @return RequestSupervisorInterface
     */
    public function getRequestSupervisor(): RequestSupervisorInterface
    {
        return $this->requestSupervisor;
    }
}