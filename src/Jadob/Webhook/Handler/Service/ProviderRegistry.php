<?php
declare(strict_types=1);

namespace Jadob\Webhook\Handler\Service;

use Jadob\Contracts\Webhook\WebhookProviderInterface;

class ProviderRegistry
{
    /**
     * @param array<string, WebhookProviderInterface> $providers
     */
    public function __construct(
        protected array $providers = []
    ) {
    }

    public function addProvider(WebhookProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }

    public function getProvider(string $name): WebhookProviderInterface
    {
        foreach ($this->providers as $provider) {
            if ($provider->getWebhookProviderName() === $name) {
                return $provider;
            }
        }

        throw new \RuntimeException(
            sprintf('Could not find webhook provider for "%s"', $name)
        );
    }
}