<?php

namespace Jadob\Security\Auth\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Auth\AuthenticationManager;
use Jadob\Security\Auth\AuthenticationRule;
use Jadob\Security\Auth\EventListener\UserRefreshListener;
use Jadob\Security\Auth\Provider\DatabaseUserProvider;
use Jadob\Security\Auth\Provider\DatabaseUserProviderFactory;
use Jadob\Security\Auth\UserStorage;
use Symfony\Component\Serializer\Encoder\ChainEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class SecurityProvider
 * @package Jadob\Security\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class AuthProvider implements ServiceProviderInterface
{

    /**
     * @return mixed
     */
    public function getConfigNode()
    {
        return 'auth';
    }

    /**
     * @param Container $container
     * @param $config
     * @throws \RuntimeException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function register(Container $container, $config)
    {

        if (!isset($config['user_providers']['default'])) {
            throw new \RuntimeException('You should provide default user provider');
        }

        $serializerEncoders = [
            new ChainEncoder(),
            new XmlEncoder(),
            new JsonEncoder()
        ];

        $serializerNormalizers = [
            new DateTimeNormalizer(),
            new ObjectNormalizer()
        ];

        $serializer = new Serializer($serializerNormalizers, $serializerEncoders);

        $container->add('serializer', $serializer);

        $container->add(
            'auth.user.storage',
            new UserStorage($container->get('session'))
        );


        // registering auth stuff
        $userProviders = $config['user_providers'];

        $authenticationManager = new AuthenticationManager(
            $container->get('auth.user.storage'),
            $container->get('logger')
        // $authConfig
        );


        //Add default user provider
        $userProviderFactory = new DatabaseUserProviderFactory(
            $container->get('database')
        );

        $authenticationManager->addUserProviderFactory('database', $userProviderFactory);

        foreach ($userProviders as $authRuleKey => $authRuleConfig) {
            /** @var AuthenticationRule $authRule */
            $authRule = AuthenticationRule::fromArray($authRuleConfig, $authRuleKey);
            $authenticationManager->addAuthenticationRule($authRule);


        }




        $container->add('auth.authentication.manager', $authenticationManager);


        $container->get('event.listener')->addListener(
            new UserRefreshListener($container->get('auth.authentication.manager')),
            1
        );
    }
}