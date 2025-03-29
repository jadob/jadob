<?php

use Jadob\Container\Fixtures\ShopDomain\ProductService;
use Jadob\Container\Fixtures\UserDomain\DbUserRepository;
use Jadob\Container\Fixtures\UserDomain\UserNotificationService;
use Jadob\Container\Fixtures\UserDomain\UserRepositoryInterface;
use Jadob\Container\Fixtures\UserDomain\UserBirthdayService;
use Jadob\Container\Fixtures\UserDomain\UserService;

use Jadob\Container\Fixtures\KebabShop;
use Jadob\Container\Fixtures\UserDomain\UserSignupService;
use Psr\Container\ContainerInterface;

return [
    'services' => [
        /**
         * This is perfectly fine.
         */
        'kebab_shop' => new KebabShop(),
//
        /**
         * More lazy approach - class would not be created until service requested.
         */
        'user_birthday_service' => static function (): UserBirthdayService {
            return new UserBirthdayService();
        },

        /**
         * You can access a container to properly inject dependencies:
         */
        'user_service' => static function (ContainerInterface $container): UserService {
            return new UserService(
                $container->get(UserRepositoryInterface::class)
            );
        },

        /**
         * You can use class FQCN as a service id, and your own services in factory arguments
         */
        UserSignupService::class => static function (
            UserService             $userService,
            UserNotificationService $userNotificationService
        ): UserSignupService {
            return new UserSignupService(
                $userService,
                $userNotificationService
            );
        },

        UserRepositoryInterface::class => static function (ContainerInterface $container): DbUserRepository {
            return new DbUserRepository();
        },

        /**
         * You can use arrays to add service definition
         */
        'user_notification_service' => [
            'class' => UserNotificationService::class,
            'autowire' => true,
        ],

        /**
         * Same as above, but class name is a service id.
         */
        ProductService::class => [
            'autowire' => true,
        ],

    ],
    'parameters' => [
        'admin_email' => 'admin@example.com',
    ],

];