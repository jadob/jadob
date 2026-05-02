<?php
declare(strict_types=1);

namespace Jadob\Auth\Firewall;

use Jadob\Auth\Identity\IdentityProviderInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;

class FirewallTest extends TestCase
{
    private RequestMatcherInterface&MockObject $requestMatcher;

    private Firewall $firewall;

    protected function setUp(): void
    {
        $this->requestMatcher = $this->createMock(RequestMatcherInterface::class);
        $this->firewall = new Firewall(
            name: 'test_firewall',
            requestMatcher: $this->requestMatcher,
            authenticators: [],
            identityProvider: $this->createStub(IdentityProviderInterface::class),
        );
    }


    public function testHandlingRequestMatcher(): void
    {
        $this->requestMatcher->expects(self::once())->method('matches')->willReturn(true);
        self::assertTrue($this->firewall->supports(Request::createFromGlobals()));
    }


    /**
     * @throws FirewallLogicException
     */
    public function testEnablingIdentityStackingWillCauseAnExceptionOnStatelessFirewalls()
    {
        $this->expectException(FirewallLogicException::class);
        $this->expectExceptionMessage('Identity stacking is not available for stateless firewalls. Set identityStackingEnabled to false for firewall test_firewall or make it stateful.');

        new Firewall(
            name: 'test_firewall',
            requestMatcher: $this->requestMatcher,
            authenticators: [],
            identityProvider: $this->createStub(IdentityProviderInterface::class),
            stateless: true,
            identityStackingEnabled: true,
        );
    }
}