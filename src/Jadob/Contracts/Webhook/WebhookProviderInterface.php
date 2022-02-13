<?php
declare(strict_types=1);

namespace Jadob\Contracts\Webhook;

interface WebhookProviderInterface
{
    public function getWebhookProviderName(): string;
    public function getEventExtractor(): EventExtractorInterface;
    public function getRequestValidator(): ?RequestValidatorInterface;

}