<?php

namespace Jadob\Container\Compiler\Extension;

use Jadob\Container\Fixtures\SampleApp\Application\Service\UserService;
use Jadob\Container\Fixtures\SampleApp\Domain\Repository\UserRepositoryInterface;
use Jadob\Container\ServiceGraph;
use Jadob\Contracts\DependencyInjection\ReferenceType;
use Jadob\Contracts\DependencyInjection\ServiceDefinition;
use PHPUnit\Framework\TestCase;

final class ResolveFactoryArgumentsTest extends TestCase
{

    public function testResolvingClassTypeArgumentWithoutInjectHint()
    {
        $definition = new ServiceDefinition('test', UserService::class);
        $definition->withFactory(
            fn(UserRepositoryInterface $userRepository): UserService => new UserService($userRepository)
        );

        $graph = new ServiceGraph();
        $graph->add($definition);

        self::assertCount(0, $definition->arguments);

        $resolve = new ResolveFactoryArguments();
        $resolve->onContainerBuild($graph);

        self::assertTrue($definition->hasArgument('userRepository'));
        self::assertEquals(
            UserRepositoryInterface::class,
            $definition->arguments['userRepository']->value
        );

        self::assertEquals(
            ReferenceType::Service,
            $definition->arguments['userRepository']->type
        );

    }
}