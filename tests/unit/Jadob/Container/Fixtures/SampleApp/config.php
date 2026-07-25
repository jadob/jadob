<?php

use Jadob\Container\Fixtures\SampleApp\Application\Service\UserService;
use Jadob\Container\Fixtures\SampleApp\Domain\Repository\UserRepositoryInterface;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\Persistence\DynamoDbUserRepository;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;

return function (ContainerBuilderInterface $builder) {
    $builder->set(UserService::class);

    $builder->set(DynamoDbUserRepository::class);
    $builder->bind(
        UserRepositoryInterface::class,
        DynamoDbUserRepository::class
    );

};