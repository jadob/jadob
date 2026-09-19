<?php

declare(strict_types=1);

namespace Jadob\Container\Fixtures\SampleApp\Infrastructure\Email;

use Jadob\Container\Fixtures\SampleApp\Application\Service\UserNotificationServiceInterface;

class UserMailerService implements UserNotificationServiceInterface
{
    public function __construct(
        private string $smtpHost,
        private int $smtpPort,
        private string $smtpUser,
        private string $smtpPass,
    )
    {
    }
}