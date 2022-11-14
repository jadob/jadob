<?php

declare(strict_types=1);

namespace Jadob\Contracts\Auth\Identity;

use Jadob\Contracts\Auth\Exception\IdentityNotFoundException;

interface IdentityProviderInterface
{

    /**
     * @param array|string $credentials
     * @return IdentityInterface
     * @throws IdentityNotFoundException
     */
    public function getByCredentials(array|string $credentials): IdentityInterface;
}