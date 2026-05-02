<?php
declare(strict_types=1);

namespace Jadob\Auth\ServiceProvider;

class FirewallConfig
{
    private array $authenticators = [];
    private ?string $successHandlerServiceId = null;
    private ?string $failureHandlerServiceId = null;
    private ?bool $stateless = null;

    public function __construct(
        private string $name,
    ) {
    }
}