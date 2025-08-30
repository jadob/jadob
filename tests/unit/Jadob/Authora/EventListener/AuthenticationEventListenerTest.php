<?php

namespace Jadob\Authora\EventListener;

use Jadob\Authora\AuthenticatorHandler\AuthenticatorHandlerFactory;
use Jadob\Authora\AuthenticatorService;
use Jadob\Authora\Fixtures\DummyIdentityProvider;
use Jadob\Authora\Fixtures\DummyStatelessAuthenticator;
use Jadob\Contracts\Auth\AccessTokenStorageInterface;
use Jadob\Core\Event\RequestEvent;
use Jadob\TestValueProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AuthenticationEventListenerTest extends TestCase
{
    public function testListenersForRequestEventAreExposed(): void
    {
        $service = new AuthenticationEventListener(
            $this->createMock(AuthenticatorService::class),
            $this->createMock(AccessTokenStorageInterface::class),
        );


        self::assertCount(
            1,
            $service->getListenersForEvent(new RequestEvent(TestValueProvider::requestContext()))
        );
    }

    public function testHandlingStatelessAuthenticatorWillCauseIdentityStorageNotToBeInvoked(): void
    {
        $authenticatorService = new AuthenticatorService();

        $authenticatorService
            ->registerNewAuthenticator(
                'api1',
                new DummyStatelessAuthenticator('/api/v1/pets'),
                new DummyIdentityProvider()
            );


        $service = new AuthenticationEventListener(
            $authenticatorService,
            $this->createMock(AccessTokenStorageInterface::class),
            new AuthenticatorHandlerFactory()
        );

        $service->onRequestEvent(
            new RequestEvent(TestValueProvider::requestContext('/api/v1/pets')),
        );
    }
}