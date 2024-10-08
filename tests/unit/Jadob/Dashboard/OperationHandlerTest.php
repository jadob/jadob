<?php
declare(strict_types=1);

namespace Jadob\Dashboard;

use DateTimeImmutable;
use Jadob\Dashboard\Bridge\Jadob\DashboardContext;
use Jadob\Dashboard\Configuration\EntityOperation;
use Jadob\Dashboard\Exception\DashboardException;
use Jadob\Dashboard\Fixtures\Cat;
use Jadob\Dashboard\Fixtures\InvokableService;
use Jadob\Dashboard\Fixtures\Tuna;
use Jadob\Security\Auth\User\User;
use Psr\Log\NullLogger;

class OperationHandlerTest extends BaseDashboardTestCase
{

    public function testHandlerWillCallInvokeWhenThereIsNoHandlerMethodPassedAndNoForcePersist(): void
    {
        $dateTime = new DateTimeImmutable('2021-03-20');
        $cat = new Cat('Mruczek', 'American Shorthair');
        $context = new DashboardContext($dateTime, new User('miki', 'miki'));

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
        $context = new DashboardContext($dateTime, new User('miki', 'miki'));

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
        $context = new DashboardContext($dateTime, new User('miki', 'miki'));

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
        $context = new DashboardContext($dateTime, new User('miki', 'miki'));

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
        $context = new DashboardContext($dateTime, new User('miki', 'miki'));
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
            fn() => [$food],
            true
        );

        $operationHandler->processOperation($operation, $cat, $context);
    }

    public function testHandlerWillBreakWhenInvalidArgumentTransformerValueIsReturned(): void
    {

        $dateTime = new DateTimeImmutable('2021-03-20');
        $context = new DashboardContext($dateTime, new User('miki', 'miki'));
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
            fn() => 'cardboard',
            true
        );

        $this->expectException(DashboardException::class);
        $this->expectExceptionMessage('Argument transformer should return an array.');

        $operationHandler->processOperation($operation, $cat, $context);
    }

}