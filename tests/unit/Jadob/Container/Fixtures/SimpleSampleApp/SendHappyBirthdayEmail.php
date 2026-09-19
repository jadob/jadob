<?php

namespace Jadob\Container\Fixtures\SimpleSampleApp;

use Jadob\Contracts\DependencyInjection\Attribute\InjectService;

class SendHappyBirthdayEmail
{

    public function __construct(
        private UserService $userService,
        #[InjectService(MailerService::class)]
        private MailerInterface $mailerService,
    )
    {
    }
}