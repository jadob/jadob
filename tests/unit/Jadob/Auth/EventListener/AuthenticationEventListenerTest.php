<?php

namespace Jadob\Auth\EventListener;

use Jadob\Auth\AccessToken\AccessToken;
use Jadob\Auth\AccessToken\AccessTokenStorage;
use Jadob\Auth\AccessToken\AccessTokenStorageInterface;
use Jadob\Auth\EventListener\AuthenticationEventListener;
use Jadob\Auth\Firewall\FirewallInterface;
use Jadob\Auth\Firewall\FirewallMap;
use Jadob\Auth\Firewall\FirewallMapInterface;
use Jadob\Core\Event\RequestEvent;
use Jadob\Core\RequestContext;
use Jadob\TestValueProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationEventListenerTest extends TestCase
{

    private FirewallMapInterface&MockObject $firewallMap;
    private LoggerInterface&Stub $logger;
    private AccessTokenStorageInterface&MockObject $accessTokenStorage;
    private FirewallInterface&MockObject $firewall;

    private AuthenticationEventListener $service;

    protected function setUp(): void
    {
        $this->firewallMap = $this->createMock(FirewallMapInterface::class);
        $this->logger = self::createStub(LoggerInterface::class);
        $this->accessTokenStorage = $this->createMock(AccessTokenStorageInterface::class);
        $this->firewall = $this->createMock(FirewallInterface::class);

        $this->service = new AuthenticationEventListener(
            firewallMap: $this->firewallMap,
            logger: $this->logger,
            accessTokenStorage: $this->accessTokenStorage,
        );
    }

    public function testEarlyReturnOnNoSuitableFirewall(): void
    {
        $this->firewallMap->method('match')->willReturn(null);

        $this->firewall->expects($this->never())->method(self::anything());

        $this->service->handleAuthentication(
            new RequestEvent(
                TestValueProvider::requestContext()
            )
        );


    }
}