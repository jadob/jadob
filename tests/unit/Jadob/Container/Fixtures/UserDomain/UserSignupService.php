<?php
declare(strict_types=1);

namespace Jadob\Container\Fixtures\UserDomain;

class UserSignupService
{
    public function __construct(
        /** @phpstan-ignore property.onlyWritten (FIXTURE) */
        private UserService $userService,
        /** @phpstan-ignore property.onlyWritten (FIXTURE) */
        private UserNotificationService $userNotificationService

    ) {
    }
}