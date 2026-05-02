<?php
declare(strict_types=1);

namespace Jadob\Auth\AccessToken;

final readonly class AccessToken
{
    public function __construct(
        private(set) string $identityId,
        private(set) array  $metadata = [],
    ) {
    }
}