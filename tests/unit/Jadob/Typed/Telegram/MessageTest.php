<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;

use Jadob\FixtureHelper;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{

    public function testMessageWithPhoto(): void
    {
        $data = FixtureHelper::getJson('telegram-message-photo');
        $msg = Message::fromArray($data);

        self::assertTrue($msg->hasPhoto());

    }

    public function testPlainMessage(): void
    {
        $data = FixtureHelper::getJson('telegram-message');
        $msg = Message::fromArray($data);

        self::assertFalse($msg->hasPhoto());

    }
}