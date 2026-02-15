<?php

namespace Jadob\Authora\EventListener;

use Jadob\Authora\AuthenticatorHandler\AuthenticatorHandlerFactory;
use Jadob\Authora\Authenticator;
use Jadob\Authora\Fixtures\DummyIdentityProvider;
use Jadob\Authora\Fixtures\DummyStatelessAuthenticator;
use Jadob\Contracts\Auth\IdentityPoolInterface;
use Jadob\Core\Event\RequestEvent;
use Jadob\TestValueProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AuthenticationEventListenerTest extends TestCase
{
    public function testListenersForRequestEventAreExposed(): void
    {
        $service = new AuthenticationEventListener(
            $this->createMock(Authenticator::class),
            $this->createMock(IdentityPoolInterface::class),
            $this->createMock(AuthenticatorHandlerFactory::class),
        );


        self::assertCount(
            1,
            $service->getListenersForEvent(new RequestEvent(TestValueProvider::requestContext()))
        );
    }

    public function testHandlingStatelessAuthenticatorWillCauseIdentityStorageNotToBeInvoked(): void
    {
        $authenticatorService = new Authenticator();

        $authenticatorService
            ->registerNewAuthenticator(
                'api1',
                new DummyStatelessAuthenticator('/api/v1/pets'),
                new DummyIdentityProvider()
            );


        $storageMock = $this->createMock(IdentityPoolInterface::class);
        $service = new AuthenticationEventListener(
            $authenticatorService,
            $storageMock,
            new AuthenticatorHandlerFactory()
        );

        $storageMock->expects($this->never())->method($this->anything());
        $service->onRequestEvent(
            new RequestEvent(TestValueProvider::requestContext('/api/v1/pets')),
        );
    }
}