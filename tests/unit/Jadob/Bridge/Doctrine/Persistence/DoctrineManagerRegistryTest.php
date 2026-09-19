<?php

namespace Jadob\Bridge\Doctrine\Persistence;

use Doctrine\Persistence\ConnectionRegistry;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;

final class DoctrineManagerRegistryTest extends TestCase
{

    public function testResettingManagerWillCauseObjectManagerFactoryToBeInvoked(): void
    {

        $factoryMock = $this->createMock(ObjectManagerFactoryInterface::class);
        $factoryMock
            ->expects($this->exactly(2))
            ->method('build')
            ->willReturnCallback(
               fn() => $this->createStub(ObjectManager::class),
            );

        $registry = new DoctrineManagerRegistry(
            entityManagerFactories: [
                'test' => $factoryMock,
            ],
            defaultManagerName: 'test',
            connectionRegistry: $this->createStub(ConnectionRegistry::class),
        );

        $preResetInstance = $registry->getManager('test');
        $postResetInstance = $registry->resetManager('test');

        self::assertNotSame(
            $preResetInstance,
            $postResetInstance
        );
    }
}