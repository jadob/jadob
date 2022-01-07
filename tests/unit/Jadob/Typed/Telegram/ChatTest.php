<?php
declare(strict_types=1);

namespace Jadob\Typed\Telegram;


use PHPUnit\Framework\TestCase;

class ChatTest extends TestCase
{

    public function testFromArrayCreation(): void
    {
        $data = [
            'id' => 3456789012,
            'type' => 'private',
            'first_name' => 'Tony',
            'last_name' => 'Stark',
            'username' => 'WarMachine68',
        ];

        $chat = Chat::fromArray($data);
        self::assertEquals('WarMachine68', $chat->getUsername());
    }
}