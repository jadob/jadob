<?php
declare(strict_types=1);

namespace Jadob\Webhook\Provider\Telegram;

use Jadob\Contracts\Webhook\EventExtractorInterface;
use Jadob\Typed\Telegram\Update;
use Jadob\Webhook\Provider\Telegram\Event\TelegramEvent;
use LogicException;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\HttpFoundation\Request;

class TelegramEventExtractor implements EventExtractorInterface
{

    public function canProcess(Request $request): bool
    {
        try {
            $payload = $request->toArray();
        } catch (JsonException) {
            return false;
        }

        if(!isset($payload['payload'])) {
            return false;
        }

        return isset($payload['payload']['update_id']);
    }

    public function extractEvent(Request $request): object
    {
        return Update::fromArray($request->toArray()['payload']);
    }

    public function wrapEvent(object $object): object
    {
        if(!($object instanceof Update)) {
            throw new LogicException('TelegramEventProcessor#wrapEvent allows only Update event.');
        }

        return new TelegramEvent($object);
    }
}