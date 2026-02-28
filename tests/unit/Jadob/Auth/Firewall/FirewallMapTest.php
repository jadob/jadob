<?php

namespace Jadob\Auth\Firewall;

use Jadob\Auth\AuthenticatorInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class FirewallMapTest extends TestCase
{

    public function testFirewallMapWouldReturnNullOnNoFirewallPresent()
    {
        $map = new FirewallMap();

        self::assertNull($map->match(Request::createFromGlobals()));
    }


    public function testNegativeResponseFromRequestMatchedWouldCauseMatchToNotReturnFirewall()
    {
        $authMock = $this->createMock(Firewall::class);
        $authMock->expects(self::once())->method('supports')->willReturn(false);

        $map = new FirewallMap(
            [
                $authMock,
            ]
        );

        self::assertNull($map->match(Request::createFromGlobals()));
    }
}