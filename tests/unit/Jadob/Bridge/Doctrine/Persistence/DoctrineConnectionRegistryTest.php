<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Persistence;

use Doctrine\DBAL\Connection;
use PHPUnit\Framework\TestCase;

final class DoctrineConnectionRegistryTest extends TestCase
{
    public function testDefaultConnectionName(): void
    {
        $registry = new DoctrineConnectionRegistry(
            [],
            'default'
        );

        self::assertSame('default', $registry->getDefaultConnectionName());
    }

    public function testGettingConnectionWithoutNameWillCauseDefaultConnectionToBeReturned(): void
    {
        $defaultStub = $this->createStub(Connection::class);

        $registry = new DoctrineConnectionRegistry(
            [
                'default' => $defaultStub,
            ],
            'default'
        );

        self::assertSame($defaultStub, $registry->getConnection());
    }

    public function testGettingConnectionWithNameWillCauseSpecificConnectionToBeReturned(): void
    {
        $defaultStub = $this->createStub(Connection::class);
        $otherConnection = $this->createStub(Connection::class);

        $registry = new DoctrineConnectionRegistry(
            [
                'default' => $defaultStub,
                'other' => $otherConnection,
            ],
            'default'
        );

        self::assertSame($otherConnection, $registry->getConnection('other'));

    }

}