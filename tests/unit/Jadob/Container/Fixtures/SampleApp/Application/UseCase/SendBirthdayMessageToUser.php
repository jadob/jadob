<?php

namespace Jadob\Container\Fixtures\SampleApp\Application\UseCase;

use Jadob\Container\Fixtures\SampleApp\Application\Service\UserNotificationServiceInterface;
use Jadob\Container\Fixtures\SampleApp\Application\Service\UserService;

class SendBirthdayMessageToUser
{
    public function __construct(
        private UserService $userService,
        private UserNotificationServiceInterface $userNotificationService
    )
    {
    }
}