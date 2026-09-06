<?php

namespace Jadob\Auth\EventListener;

use Jadob\Auth\AccessToken\AccessToken;
use Jadob\Auth\AccessToken\AccessTokenStorage;
use Jadob\Auth\AccessToken\AccessTokenStorageInterface;
use Jadob\Auth\AuthenticatorInterface;
use Jadob\Auth\EventListener\AuthenticationEventListener;
use Jadob\Auth\Firewall\FirewallInterface;
use Jadob\Auth\Firewall\FirewallMap;
use Jadob\Auth\Firewall\FirewallMapInterface;
use Jadob\Auth\Identity\IdentityPickerInterface;
use Jadob\Auth\Identity\IdentityProviderInterface;
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
    private IdentityPickerInterface&MockObject $identityPicker;
    private IdentityProviderInterface&MockObject $identityProvider;
    private AuthenticatorInterface&MockObject $authenticator;

    private AuthenticationEventListener $service;

    protected function setUp(): void
    {
        $this->firewallMap = $this->createMock(FirewallMapInterface::class);
        $this->firewall = $this->createMock(FirewallInterface::class);
        $this->logger = self::createStub(LoggerInterface::class);
        $this->accessTokenStorage = $this->createMock(AccessTokenStorageInterface::class);
        $this->identityPicker = $this->createMock(IdentityPickerInterface::class);
        $this->identityProvider = $this->createMock(IdentityProviderInterface::class);
        $this->authenticator = $this->createMock(AuthenticatorInterface::class);

        $this->firewallMap->method('match')->willReturn($this->firewall);

        $this->firewall->method('getIdentityPicker')->willReturn($this->identityPicker);
        $this->firewall->method('getIdentityProvider')->willReturn($this->identityProvider);
        $this->firewall->method('getAuthenticators')->willReturn([$this->authenticator]);

        $this->service = new AuthenticationEventListener(
            firewallMap: $this->firewallMap,
            logger: $this->logger,
            accessTokenStorage: $this->accessTokenStorage,
        );
    }

//    public function testEarlyReturnOnNoSuitableFirewall(): void
//    {
//        $this->firewallMap->method('match')->willReturn(null);
//
//        $this->firewall->expects($this->never())->method(self::anything());
//
//        $this->service->handleAuthentication(
//            new RequestEvent(
//                TestValueProvider::requestContext()
//            )
//        );
//    }

//    public function testIdentityStackingWillCallIdentityPickerToEstablishIdentityToUse(): void
//    {
//        $this->firewall->method('isIdentityStackingEnabled')->willReturn(true);
//        $this->firewall->method('isStateless')->willReturn(false);
//
//        $this->accessTokenStorage->method('getAllTokens')->willReturn([
//            $token = new AccessToken("A"),
//            new AccessToken("B"),
//        ]);
//
//        $this->identityPicker->expects($this->once())->method('pick')->willReturn($token);
//        $this->identityProvider->expects($this->once())->method('getByIdentifier')->with('A');
//
//        $context = TestValueProvider::requestContext();
//        $this->service->handleAuthentication(
//            new RequestEvent(
//                $context
//            )
//        );
//    }

    public function testSuccessfulAuthenticationWithIdentityStackingEnabled(): void
    {
        $token = new AccessToken("A");
        $this->firewall->method('isIdentityStackingEnabled')->willReturn(true);
        $this->firewall->method('isStateless')->willReturn(false);

        $this->authenticator->expects($this->once())->method('authenticate')->willReturn($token);
        $this->authenticator->expects($this->once())->method('supports')->willReturn(true);
        $this->authenticator->expects($this->once())->method('onAuthenticationSuccess');
        $this->authenticator->expects($this->never())->method('onAuthenticationFailure');

        $this->accessTokenStorage->expects($this->once())->method('saveToSession');
        $this->accessTokenStorage->expects($this->once())->method('storeCurrent');


        $context = TestValueProvider::requestContext();
        $this->service->handleAuthentication(
            new RequestEvent(
                $context
            )
        );
    }
}