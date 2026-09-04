<?php
declare(strict_types=1);

namespace Jadob\Auth;

use Jadob\Auth\AccessToken\AccessToken;
use Jadob\Auth\AccessToken\AccessTokenStorage;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

final class AccessTokenStorageTest extends TestCase
{
    private SessionInterface $session;
    private AccessTokenStorage $storage;

    protected function setUp(): void
    {
        $this->storage = new AccessTokenStorage();
        $this->session = new Session(new MockArraySessionStorage());
    }

    public function testSaveToSessionWillAttachUniqueIdsToEachStoredToken(): void
    {
        $id1 = $this
            ->storage
            ->saveToSession(
                $this->session,
                new AccessToken('1')
            );

        $id2 = $this
            ->storage
            ->saveToSession(
                $this->session,
                new AccessToken('2')
            );

        self::assertEquals(1, $id1);
        self::assertEquals(2, $id2);
    }
}