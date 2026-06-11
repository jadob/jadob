<?php
declare(strict_types=1);

namespace Jadob\Auth\Firewall;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class FirewallMapTest extends TestCase
{
    public function testFirewallMapWouldReturnNullOnNoFirewallPresent():  void
    {
        $map = new FirewallMap();

        self::assertNull($map->match(Request::createFromGlobals()));
    }


    public function testNegativeResponseFromRequestMatchedWouldCauseMatchToNotReturnFirewall(): void
    {
        $firewall = $this->createMock(FirewallInterface::class);
        $firewall->expects(self::once())->method('supports')->willReturn(false);

        $map = new FirewallMap(
            [
                $firewall,
            ]
        );

        self::assertNull($map->match(Request::createFromGlobals()));
    }
}