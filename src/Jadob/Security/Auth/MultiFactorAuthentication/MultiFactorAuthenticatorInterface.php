<?php

declare(strict_types=1);
namespace Jadob\Security\Auth\MultiFactorAuthentication;

interface MultiFactorAuthenticatorInterface
{
    public function getMfaChallenges(): array;
}