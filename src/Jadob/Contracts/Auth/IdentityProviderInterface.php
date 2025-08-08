<?php

namespace Jadob\Contracts\Auth;

/**
 * Used to fetch identity from your persistence layer (DB, API, anything).
 */
interface IdentityProviderInterface
{
    public function getByIdentifier(string $identityId): IdentityInterface;
}