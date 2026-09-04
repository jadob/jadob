<?php

namespace Jadob\Container\Compiler;

use Jadob\Container\Fixtures\InvalidServiceHints\TwoInjectServiceHintsInOneProperty;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\Persistence\DynamoDbUserRepository;
use Jadob\Contracts\DependencyInjection\Reference;
use LogicException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ArgumentInjectHintsHandlerTest extends TestCase
{
    public function testProcessingInjectServiceHint(): void
    {
        $refClass = new ReflectionClass(DynamoDbUserRepository::class);
        $constructorInjectPropertyReflection = $refClass
            ->getConstructor()
            ->getParameters()[0];

        $result = ArgumentInjectHintsHandler::process($constructorInjectPropertyReflection);

        self::assertInstanceOf(Reference::class, $result);

    }

    public function testMultipleInjectServiceInOnePropertyWillThrowAnError(): void
    {
        $refClass = new ReflectionClass(TwoInjectServiceHintsInOneProperty::class);
        $constructorInjectPropertyReflection = $refClass
            ->getConstructor()
            ->getParameters()[0];

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('More than one #[InjectService] attribute is attached to constructor property.');

        ArgumentInjectHintsHandler::process($constructorInjectPropertyReflection);
    }
}