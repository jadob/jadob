<?php
declare(strict_types=1);

namespace Jadob\Webhook\Provider\Telegram;

use Jadob\Contracts\Webhook\EventExtractorInterface;
use Jadob\Typed\Telegram\Update;
use Symfony\Component\HttpFoundation\Request;

class TelegramEventExtractor implements EventExtractorInterface
{

    public function canProcess(Request $request): bool
    {
        $payload = $request->toArray();
        return isset($payload['update_id']);
    }

    public function extractEvent(Request $request): object
    {
        return Update::fromArray($request->toArray());
    }
}