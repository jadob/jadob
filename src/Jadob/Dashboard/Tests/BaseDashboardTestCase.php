<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Tests;


use Jadob\Dashboard\ObjectManager\DoctrineOrmObjectManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

abstract class BaseDashboardTestCase extends TestCase
{
    public function getContainerMock(): ContainerInterface
    {
        return $this->getMockBuilder(ContainerInterface::class)
            ->getMock();
    }

    public function getObjectManagerMock(): DoctrineOrmObjectManager
    {
        return $this->getMockBuilder(DoctrineOrmObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}