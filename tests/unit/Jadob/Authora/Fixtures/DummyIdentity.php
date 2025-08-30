<?php

namespace Jadob\Authora\Fixtures;

use Jadob\Contracts\Auth\IdentityInterface;

class DummyIdentity implements IdentityInterface
{
    public function __construct(
        private string $identityId,
    )
    {
    }

    public function getIdentityId(): string
    {
        return $this->identityId;
    }
}