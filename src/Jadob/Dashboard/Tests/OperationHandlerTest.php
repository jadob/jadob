<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Tests;

use DateTimeImmutable;
use Jadob\Dashboard\Configuration\EntityOperation;
use Jadob\Dashboard\DashboardContext;
use Jadob\Dashboard\Exception\DashboardException;
use Jadob\Dashboard\OperationHandler;
use Jadob\Dashboard\Tests\Fixtures\Cat;
use Jadob\Dashboard\Tests\Fixtures\InvokableService;
use Jadob\Dashboard\Tests\Fixtures\Tuna;
use Psr\Log\NullLogger;

class OperationHandlerTest extends BaseDashboardTestCase
{

    public function testHandlerWillCallInvokeWhenThereIsNoHandlerMethodPassedAndNoForcePersist(): void
    {
        $dateTime = new DateTimeImmutable('2021-03-20');
        $cat = new Cat('Mruczek', 'American Shorthair');
        $context = new DashboardContext($dateTime);

        $doctrineMock = $this->getObjectManagerMock();

        $service = $this->getMockBuilder(InvokableService::class)
            ->getMock();

        $service->expects(self::once())
            ->method('__invoke')
            ->with(self::equalTo($cat));

        $container = $this->getContainerMock();

        $container->expects(self::once())
            ->method('get')
            ->with(self::equalTo(InvokableService::class))
            ->willReturn($service);

        $operation = new EntityOperation(
            'dashboard_test',
            'dashboard_test',
            InvokableService::class
        );

        $operationHandler = new OperationHandler(
            $container,
            new NullLogger(),
            $doctrineMock
        );

        $operationHandler->processOperation($operation, $cat, $context);
    }

    public function testHandlerWillForcePersistOnObject(): void
    {
        $dateTime = new DateTimeImmutable('2021-03-20');
        $cat = new Cat('Andrew', 'Munchkin');
        $context = new DashboardContext($dateTime);

        $operation = new EntityOperation(
            'dashboard_test',
            'dashboard_test',
            InvokableService::class,
            null,
            null,
            true
        );


        $doctrineMock = $this->getObjectManagerMock();
        $doctrineMock->expects(self::once())
            ->method('persist')
            ->with(self::equalTo($cat));

        $container = $this->getContainerMock();
        $container->method('get')
            ->willReturn(new InvokableService());

        $operationHandler = new OperationHandler(
            $container,
            new NullLogger(),
            $doctrineMock
        );

        $operationHandler->processOperation($operation, $cat, $context);

    }

    public function testHandlerWillCallMethodOnObjectWhenNoHandlerFqcnPassed(): void
    {
        $dateTime = new DateTimeImmutable('2021-03-20');
        $context = new DashboardContext($dateTime);

        $operation = new EntityOperation(
            'dashboard_test',
            'dashboard_test',
            null,
            'meow',
            null,
            true
        );


        $cat = $this->getMockBuilder(Cat::class)
            ->setConstructorArgs(['Bonaparte', 'Napoleon'])
            ->getMock();

        $cat->expects(self::once())
            ->method('meow');

        $container = $this->getContainerMock();
        $container->expects(self::never())
            ->method('get');


        $operationHandler = new OperationHandler(
            $container,
            new NullLogger(),
            $this->getObjectManagerMock()
        );

        $operationHandler->processOperation($operation, $cat, $context);

    }

    public function testHandlerWillCatchExceptionAndPassItOn(): void
    {
        $dateTime = new DateTimeImmutable('2021-03-20');
        $context = new DashboardContext($dateTime);

        $cat = new Cat('Chodge', 'Foldex');

        $operation = new EntityOperation(
            'dashboard_test',
            'dashboard_test',
            null,
            'woof',
            null,
            true
        );

        $loggerMock = $this->getMockBuilder(NullLogger::class)
            ->getMock();

        $loggerMock->expects(self::once())
            ->method('critical')
            ->with(self::equalTo('Caught an exception during processing: am i a joke to you?'));


        $operationHandler = new OperationHandler(
            $this->getContainerMock(),
            $loggerMock,
            $this->getObjectManagerMock()
        );

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('am i a joke to you?');

        $operationHandler->processOperation($operation, $cat, $context);
    }


    public function testArgumentTransformerPassedInOperationIsUsed()
    {

        $dateTime = new DateTimeImmutable('2021-03-20');
        $context = new DashboardContext($dateTime);
        $food = new Tuna();

        $cat = $this->getMockBuilder(Cat::class)
            ->setConstructorArgs(['Your name here', 'Highlander'])
            ->getMock();

        $cat->expects(self::once())
            ->method('feed')
            ->with(self::equalTo($food));

        $operationHandler = new OperationHandler(
            $this->getContainerMock(),
            new NullLogger(),
            $this->getObjectManagerMock()
        );

        $operation = new EntityOperation(
            'dashboard_test',
            'dashboard_test',
            null,
            'feed',
            function () use ($food) {
                return [$food];
            },
            true
        );

        $operationHandler->processOperation($operation, $cat, $context);
    }

    public function testHandlerWillBreakWhenInvalidArgumentTransformerValueIsReturned(): void
    {

        $dateTime = new DateTimeImmutable('2021-03-20');
        $context = new DashboardContext($dateTime);
        $cat = new Cat('cheezburger', 'Lykoi');

        $operationHandler = new OperationHandler(
            $this->getContainerMock(),
            new NullLogger(),
            $this->getObjectManagerMock()
        );

        $operation = new EntityOperation(
            'dashboard_test',
            'dashboard_test',
            null,
            'feed',
            function () {
                return 'cardboard';
            },
            true
        );

        $this->expectException(DashboardException::class);
        $this->expectExceptionMessage('Argument transformer should return an array.');

        $operationHandler->processOperation($operation, $cat, $context);
    }

}