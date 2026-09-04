<?php
declare(strict_types=1);

namespace Jadob\Auth;

use Jadob\Auth\AccessToken\AccessToken;
use Jadob\Auth\AccessToken\AccessTokenStorage;
use PHPUnit\Framework\TestCase;
use RuntimeException;
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

    public function testRemovingAccessTokenFromSessionWillNotCauseAccessTokenIdsToBeReused(): void
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

        $this
            ->storage
            ->removeTokenFromSession(
                $this->session,
                $id2
        );

        $id3 = $this
            ->storage
            ->saveToSession(
                $this->session,
                new AccessToken('3')
            );

        self::assertEquals(1, $id1);
        self::assertEquals(3, $id3);
    }

    public function testRemovingNonExistingTokenWillCauseExceptionToBeThrown(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Access token with id "1" does not exist in session.');
        $this
            ->storage
            ->removeTokenFromSession(
                $this->session,
                1
        );
    }
}