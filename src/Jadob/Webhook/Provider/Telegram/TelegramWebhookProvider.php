<?php
declare(strict_types=1);

namespace Jadob\Webhook\Provider\Telegram;


use Jadob\Contracts\Webhook\EventExtractorInterface;
use Jadob\Contracts\Webhook\RequestValidatorInterface;
use Jadob\Contracts\Webhook\WebhookProviderInterface;

class TelegramWebhookProvider implements WebhookProviderInterface
{

    public function getWebhookProviderName(): string
    {
        return 'telegram';
    }

    public function getEventExtractor(): EventExtractorInterface
    {
        return new TelegramEventExtractor();
    }

    public function getRequestValidator(): ?RequestValidatorInterface
    {
        return null;
    }
}