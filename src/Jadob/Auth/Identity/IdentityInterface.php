<?php
declare(strict_types=1);

namespace Jadob\Auth\Identity;

interface IdentityInterface
{
    public function getIdentifier(): string;
}