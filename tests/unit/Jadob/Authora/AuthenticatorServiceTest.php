<?php

namespace Jadob\Authora;

use Jadob\Authora\Fixtures\DummyIdentityProvider;
use Jadob\Authora\Fixtures\DummyStatelessAuthenticator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class AuthenticatorServiceTest extends TestCase
{
    private AuthenticatorService $authenticatorService;

    protected function setUp(): void
    {
        $this->authenticatorService = new AuthenticatorService();
    }

    public function testDeterminingExistingAuthenticators()
    {
        $this->authenticatorService->registerNewAuthenticator(
            'api1',
            new DummyStatelessAuthenticator('/api/v1'),
            new DummyIdentityProvider()
        );

        $this->authenticatorService->registerNewAuthenticator(
            'api2',
            new DummyStatelessAuthenticator('/api/v2'),
            new DummyIdentityProvider()
        );

        $authenticatorName = $this
            ->authenticatorService
            ->determineEventListenerForRequest(
                Request::create('/api/v1'),
            );

        self::assertEquals('api1', $authenticatorName);
    }

    public function testNoneOfAuthenticatorWillBeMatchedWhenNoneSupportsTheRequest()
    {
        $this->authenticatorService->registerNewAuthenticator(
            'api1',
            new DummyStatelessAuthenticator('/api/v1'),
            new DummyIdentityProvider()
        );

        $this->authenticatorService->registerNewAuthenticator(
            'api2',
            new DummyStatelessAuthenticator('/api/v2'),
            new DummyIdentityProvider()
        );

        $authenticatorName = $this
            ->authenticatorService
            ->determineEventListenerForRequest(
                Request::create('/api/v666'),
            );

        self::assertNull($authenticatorName);
    }

    public function testNullWillBeReturnedOnEmptyAuthenticatorList()
    {
        $authenticatorName = $this
            ->authenticatorService
            ->determineEventListenerForRequest(
                Request::create('/api/v666'),
            );

        self::assertNull($authenticatorName);
    }

}