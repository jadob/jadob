<?php

declare(strict_types=1);

namespace Jadob\Contracts\Auth;

class AccessToken
{
    public function __construct(
        private(set) string $identityId,
        /**
         * Additional claims you can pass further to your controllers.
         * @var array<string, string|int|array>
         */
        private(set) array $metadata
    )
    {
    }
}