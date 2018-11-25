<?php

namespace Jadob\Security\Guard\EventListener;

use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;
use Jadob\Security\Auth\User\UserInterface;
use Jadob\Security\Auth\UserStorage;
use Jadob\Security\Guard\Guard;

/**
 * Class GuardRequestListener
 * @package Jadob\Security\Guard\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class GuardRequestListener implements BeforeControllerEventListenerInterface
{

    protected $blockPropagation = false;

    /**
     * @var Guard
     */
    protected $guard;

    /**
     * @var UserStorage
     */
    protected $storage;

    /**
     * GuardRequestListener constructor.
     * @param Guard $guard
     * @param UserStorage $storage
     */
    public function __construct(Guard $guard, UserStorage $storage)
    {
        $this->guard = $guard;
        $this->storage = $storage;
    }

    /**
     * {@inheritdoc}
     */
    public function onBeforeControllerInterface(BeforeControllerEvent $event): void
    {
        $authenticatorRule = $this->guard->matchRule($event->getRequest());


//        r($this->storage->getUser());
        if ($authenticatorRule === null) {
            return;
        }

        if ($this->storage->getUser() !== null) {
            return;
        }

        $user = null;

//        if ($this->storage->getUser() === null) {
        $credentials = $authenticatorRule->extractCredentialsFromRequest($event->getRequest());

        if ($credentials === null) {
            $this->blockPropagation = true;
            $event->setResponse($authenticatorRule->createNotLoggedInResponse());
            return;
        }

//        }

        $user = $authenticatorRule->getUserFromProvider($credentials);

        if ($user instanceof UserInterface && $authenticatorRule->verifyCredentials($credentials, $user)) {
            $this->storage->setUser($user);
            $successResponse = $authenticatorRule->createSuccessAuthenticationResponse();

            if ($successResponse !== null) {
                $this->blockPropagation = true;
                $event->setResponse($successResponse);
                return;
            }
        }

        $this->blockPropagation = true;
        $event->setResponse($authenticatorRule->createInvalidCredentialsResponse());
    }

    /**
     * {@inheritdoc}
     */
    public function isEventStoppingPropagation()
    {
        return $this->blockPropagation;
    }
}