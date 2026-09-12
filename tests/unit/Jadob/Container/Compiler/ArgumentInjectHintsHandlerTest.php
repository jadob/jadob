<?php

namespace Jadob\Container\Compiler;

use Jadob\Container\Fixtures\InvalidServiceHints\TwoInjectServiceHintsInOneProperty;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\Persistence\DynamoDbUserRepository;
use Jadob\Contracts\DependencyInjection\Reference;
use LogicException;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;

class ArgumentInjectHintsHandlerTest extends TestCase
{
    public function testProcessingInjectServiceHint(): void
    {
        $refClass = new ReflectionClass(DynamoDbUserRepository::class);

        /** @var ReflectionMethod $constructorInjectPropertyReflection */
        $constructorInjectPropertyReflection = $refClass
            ->getConstructor();

        $result = ArgumentInjectHintsHandler::process($constructorInjectPropertyReflection->getParameters()[0]);

        self::assertInstanceOf(Reference::class, $result);

    }

    public function testMultipleInjectServiceInOnePropertyWillThrowAnError(): void
    {
        $refClass = new ReflectionClass(TwoInjectServiceHintsInOneProperty::class);

        /** @var ReflectionMethod $constructorInjectPropertyReflection */
        $constructorInjectPropertyReflection = $refClass
            ->getConstructor();

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('More than one #[InjectService] attribute is attached to constructor property.');

        ArgumentInjectHintsHandler::process($constructorInjectPropertyReflection->getParameters()[0]);
    }
}