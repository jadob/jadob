<?php

declare(strict_types=1);

namespace Jadob\Authora;

use Jadob\Authora\Exception\IdentityPoolException;
use Jadob\Contracts\Auth\Identity;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class IdentityPoolTest extends TestCase
{
    private IdentityPool $pool;
    private Session $session;

    protected function setUp(): void
    {
        $this->pool = new IdentityPool();
        $this->session = new Session(new MockArraySessionStorage());
    }


//    public function testGetCurrentIdentityFromSessionReturnsNullWhenEmpty(): void
//    {
//        self::assertNull($this->pool->getCurrentIdentityFromSession($this->session, 'admin'));
//        self::assertEquals([], $this->pool->listIdentities($this->session, 'admin'));
//    }
//
    public function testPushIdentityCreatesStack(): void
    {
        $id1 = new Identity('user-1');
        $id2 = new Identity('user-2');

        $this->pool->pushIdentity($id1, 'admin', $this->session);
        $this->pool->pushIdentity($id2, 'admin', $this->session);

        $list = $this->pool->listIdentities($this->session, 'admin');

        self::assertCount(2, $list);
        self::assertSame($id1, $list[0]);
        self::assertSame($id2, $list[1]);
    }
//
    public function testFindingIdentitiesByIndexWillReturnActualIdentities(): void
    {
        $user0 = new Identity('user-0');
        $user1 = new Identity('user-1');
        $user2 = new Identity('user-2');

        $id0 = $this->pool->pushIdentity($user0, 'admin', $this->session);
        $id1 = $this->pool->pushIdentity($user1, 'admin', $this->session);
        $id2 = $this->pool->pushIdentity($user2, 'admin', $this->session);

        self::assertSame($user0, $this->pool->findIdentityByIndex($this->session, 'admin', $id0));
        self::assertSame($user1, $this->pool->findIdentityByIndex($this->session, 'admin', $id1));
        self::assertSame($user2, $this->pool->findIdentityByIndex($this->session, 'admin', $id2));
    }
//
    public function testRemovingIdentitiesWillNotReuseIndexKeys(): void
    {
        $user0 = new Identity('user-0');
        $user1 = new Identity('user-1');
        $user2 = new Identity('user-2');

        $id0 = $this->pool->pushIdentity($user0, 'admin', $this->session);
        $id1 = $this->pool->pushIdentity($user1, 'admin', $this->session);
        $this->pool->removeIdentityByIndex($this->session, 'admin', $id0);
        $this->pool->removeIdentityByIndex($this->session, 'admin', $id1);

        $id2 = $this->pool->pushIdentity($user2, 'admin', $this->session);

        self::assertGreaterThan($id0,$id1);
        self::assertGreaterThan($id1,$id2);
    }

    public function testRemovedIdentitiesWouldNotBeAvailable(): void
    {
        $user0 = new Identity('user-0');
        $id0 = $this->pool->pushIdentity($user0, 'admin', $this->session);
        $this->pool->removeIdentityByIndex($this->session, 'admin', $id0);

        self::assertNull($this->pool->findIdentityByIndex($this->session, 'admin', $id0));
    }

    public function testSettingCurrentIdentity(): void
    {
        $user = new Identity('user-2');
        $id = $this->pool->pushIdentity($user, 'admin', $this->session);

        self::assertNull($this->pool->getCurrentIdentityFromSession($this->session, 'admin'));
        $this->pool->setCurrent($id, 'admin', $this->session);
        self::assertSame($user, $this->pool->getCurrentIdentityFromSession($this->session, 'admin'));

    }

    public function testSettingCurrentIdentityWouldNotAllowToSetNonexistingIdentity(): void
    {
        $this->expectException(IdentityPoolException::class);
        $this->expectExceptionMessage('Authenticator "123456789" has no identities stored.');

        $this->pool->setCurrent(123456789, 'admin', $this->session);
    }

    public function testDifferentAuthenticatorNamesAreIsolated(): void
    {
        $this->pool->pushIdentity(new Identity('admin-user'), 'admin', $this->session);
        $this->pool->pushIdentity(new Identity('api-user'), 'api', $this->session);

        self::assertCount(1, $this->pool->listIdentities($this->session, 'admin'));
        self::assertCount(1, $this->pool->listIdentities($this->session, 'api'));
    }
}
