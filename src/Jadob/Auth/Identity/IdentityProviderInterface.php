<?php
declare(strict_types=1);

namespace Jadob\Auth\Identity;

interface IdentityProviderInterface
{
    public function getByIdentifier(string $identifier): IdentityInterface;
}