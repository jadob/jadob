<?php

namespace Jadob\Contracts\DependencyInjection;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('container')]
final class ServiceDefinitionTest extends TestCase
{
    private ServiceDefinition $service;

    protected function setUp(): void
    {
        $this->service = new ServiceDefinition(
            'test',
            'test'
        );
    }

    public function testCheckingForExistingArgument(): void
    {
        $this->service->withArgument('test', true);

        self::assertTrue($this->service->hasArgument('test'));
    }

    public function testCheckingForMissingArgument(): void
    {

        self::assertFalse($this->service->hasArgument('testArgument'));
    }

    public function testAutowiredIsNotEnabledByDefault(): void
    {
        self::assertFalse($this->service->autowired);
    }

    public function testAutowiredMethodWillEnableAutowiring(): void
    {
        $this->service->autowire();

        self::assertTrue($this->service->autowired);
    }

    public function testCheckingForTagPresence(): void
    {
        self::assertFalse($this->service->hasTag('test-tag'));

        $this->service->withTag('test-tag');

        self::assertTrue($this->service->hasTag('test-tag'));
    }

    public function testMethodCallsCollection(): void
    {
        $this->service->addMethodCall('doSomething', ['arg1' => 1]);
        $this->service->addMethodCall('doSomething', ['arg1' => 2]);
        $this->service->addMethodCall('doSomething', ['arg1' => 3]);


        self::assertCount(3, $this->service->methodCalls['doSomething']);
    }

    public function testWithArgumentWillPreventOverriding(): void
    {
        $this->service->withArgument('arg1', 1);

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Argument "arg1" is already defined, use replaceArgument() to override it.');
        $this->service->withArgument('arg1', 2);
    }

    public function testReplaceArgumentWillPreventDefining(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('Argument "arg1" does not exists, use withArgument() to define it.');
        $this->service->replaceArgument('arg1', 1);
    }

    public function testReplaceArgumentWillActuallyReplaceArgumentValue(): void
    {
        $this->service->withArgument('arg1', 1);
        $this->service->replaceArgument('arg1', 2);

        self::assertEquals(2, $this->service->arguments['arg1']->value);
    }
}