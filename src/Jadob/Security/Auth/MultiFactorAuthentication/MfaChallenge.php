<?php

declare(strict_types=1);

namespace Jadob\Security\Auth\MultiFactorAuthentication;

/**
 * Keeps information about single factor in MFA workflow.
 * @license MIT
 */
readonly class MfaChallenge
{
    public function __construct(
        protected string $name,
        /**
         * Endpoint responsible for generating a challenge
         * (e.g. pushing requests to authenticators, sending sms etc.)
         * @var string
         */
        protected string $challengePath,
        /**
         * Endpoint responsible for handling a response to the challenge.
         * @var string
         */
        protected string $responsePath
    ) {
    }
}