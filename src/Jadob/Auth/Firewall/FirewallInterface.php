<?php
declare(strict_types=1);

namespace Jadob\Auth\Firewall;

use Jadob\Auth\AuthenticatorInterface;
use Jadob\Auth\EntryPointInterface;
use Jadob\Auth\Identity\IdentityPickerInterface;
use Jadob\Auth\Identity\IdentityProviderInterface;
use Symfony\Component\HttpFoundation\Request;

interface FirewallInterface
{
    public function supports(Request $request): bool;

    public function isStateless(): bool;

    public function isIdentityStackingEnabled(): bool;

    public function getIdentityProvider(): IdentityProviderInterface;

    public function getIdentityPicker(): IdentityPickerInterface;

    /**
     * @return array<AuthenticatorInterface>
     */
    public function getAuthenticators(): array;

    public function getEntryPoint(): EntryPointInterface;
}