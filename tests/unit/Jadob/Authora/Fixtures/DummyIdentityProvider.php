<?php

namespace Jadob\Authora\Fixtures;


use Jadob\Contracts\Auth\IdentityInterface;
use Jadob\Contracts\Auth\IdentityProviderInterface;

class DummyIdentityProvider implements IdentityProviderInterface
{

    public function getByIdentifier(string $identityId): IdentityInterface
    {
        return new DummyIdentity($identityId);
    }
}