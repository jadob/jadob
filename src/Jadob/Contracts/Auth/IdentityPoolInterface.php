<?php
declare(strict_types=1);

namespace Jadob\Contracts\Auth;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

interface IdentityPoolInterface
{
    public function storeAsCurrent(
        Identity         $identity,
        string           $authenticatorName,
        SessionInterface $session
    ): void;

    public function getCurrentIdentityFromSession(
        SessionInterface $session,
        string $authenticatorName
    ): ?Identity;

    /**
     * @param SessionInterface $session
     * @param string $authenticatorName
     * @return array<Identity>
     */
    public function listIdentities(
        SessionInterface $session,
        string $authenticatorName
    ): array;
}