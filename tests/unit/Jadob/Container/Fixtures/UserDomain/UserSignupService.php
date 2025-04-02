<?php

namespace Jadob\Container\Fixtures\UserDomain;

class UserSignupService
{
    public function __construct(
        /** @phpstan-ignore property.onlyWritten */
        private UserService $userService,
        /** @phpstan-ignore property.onlyWritten */
        private UserNotificationService $userNotificationService

    )
    {
    }
}