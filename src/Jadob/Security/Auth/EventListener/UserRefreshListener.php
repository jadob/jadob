<?php

namespace Jadob\Security\Auth\EventListener;

use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;
use Jadob\Security\Auth\User\RefreshableUserInterface;
use Jadob\Security\Auth\UserStorage;
use Jadob\Security\Guard\Guard;

/**
 * Class UserRefreshListener
 * @package Jadob\Security\Auth\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class UserRefreshListener implements BeforeControllerEventListenerInterface
{

    /**
     * @var Guard
     */
    protected $guard;

    /**
     * @var UserStorage
     */
    protected $storage;

    /**
     * UserRefreshListener constructor.
     * @param Guard $guard
     * @param UserStorage $storage
     */
    public function __construct(Guard $guard, UserStorage $storage)
    {
        $this->guard = $guard;
        $this->storage = $storage;
    }

    /**
     * @param BeforeControllerEvent $event
     * @return void
     */
    public function onBeforeControllerInterface(BeforeControllerEvent $event): void
    {
        if ($this->storage->getUser() === null) {
            return;
        }


        $provider = $this->guard->getProviderByName(
            $this->guard->getCurrentGuardName()
        );

        /** @var RefreshableUserInterface $oldUser */
        $oldUser = $this->storage->getUser();

        $newUser = $provider->getOneById($oldUser->getId());


        $this->storage->setUser($newUser, $this->guard->getCurrentGuardName());
    }

    /**
     * @return bool
     */
    public function isEventStoppingPropagation()
    {
        return false;
    }
}