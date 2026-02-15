<?php
declare(strict_types=1);

namespace Jadob\Contracts\Auth;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface IdentityPoolInterface
{
    /**
     * @param int $identityIndex taken from the result of {@see IdentityPoolInterface::pushIdentity}
     * @return void
     */
    public function setCurrent(
        int              $identityIndex,
        string           $authenticatorName,
        SessionInterface $session
    ): void;

    public function getCurrentIdentityFromSession(
        SessionInterface $session,
        string           $authenticatorName,
    ): ?Identity;

    /**
     * Add an identity to the stack without replacing existing ones. Used when identity stacking is enabled.
     * @return int zero-indexed unique identifier of the identity in stack
     */
    public function pushIdentity(
        Identity         $identity,
        string           $authenticatorName,
        SessionInterface $session
    ): int;

    /**
     * @param SessionInterface $session
     * @param string $authenticatorName
     * @return array<Identity>
     */
    public function listIdentities(
        SessionInterface $session,
        string           $authenticatorName
    ): array;

    public function findIdentityByIndex(
        SessionInterface $session,
        string           $authenticatorName,
        int $index
    ): ?Identity;

    public function removeIdentityByIndex(
        SessionInterface $session,
        string           $authenticatorName,
        int $index
    ): void;
}