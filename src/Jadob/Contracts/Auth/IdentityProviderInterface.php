<?php

namespace Jadob\Contracts\Auth;

interface IdentityProviderInterface
{
    public function getByIdentifier(string $identityId): IdentityInterface;
}