<?php

declare(strict_types=1);

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\User\UserInterface;

class AccessToken
{
    public function __construct(
        protected UserInterface $identity,
        protected array $attributes,
        protected bool $partial = false
    ) {
    }
}