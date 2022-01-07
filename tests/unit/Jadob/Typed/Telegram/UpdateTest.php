<?php

declare(strict_types=1);

namespace Jadob\Typed\Telegram;

use Jadob\FixtureHelper;
use PHPUnit\Framework\TestCase;

class UpdateTest extends TestCase
{
    public function testFromArrayCreation(): void
    {
        $data = FixtureHelper::getJson('telegram-update-message');
        $update = Update::fromArray($data);
        self::assertSame(12345567890, $update->getId());
    }
}
