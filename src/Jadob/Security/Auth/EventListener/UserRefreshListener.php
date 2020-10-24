<?php

namespace Jadob\Security\Auth\EventListener;

use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;
use Jadob\Security\Auth\User\RefreshableUserInterface;
use Jadob\Security\Auth\IdentityStorage;
use Jadob\Security\Guard\Guard;

/**
 * @TODO: this class is so freaking old that needs to be refactored ASAP
 * @package Jadob\Security\Auth\EventListener
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class UserRefreshListener //implements BeforeControllerEventListenerInterface
{

    /**
     * @var Guard
     */
    protected $guard;

    /**
     * @var IdentityStorage
     */
    protected $storage;

    /**
     * UserRefreshListener constructor.
     *
     * @param Guard       $guard
     * @param IdentityStorage $storage
     */
    public function __construct(Guard $guard, IdentityStorage $storage)
    {
        $this->guard = $guard;
        $this->storage = $storage;
    }

    /**
     * @param  BeforeControllerEvent $event
     * @return void
     */
    public function onBeforeControllerEvent(BeforeControllerEvent $event): void
    {

        if ($this->storage->getUser() === null) {
            return;
        }

        $provider = $this->guard->getProviderByName(
            $this->guard->getCurrentGuardName()
        );

        /**
 * @var RefreshableUserInterface $oldUser 
*/
        $oldUser = $this->storage->getUser();

        if($oldUser instanceof RefreshableUserInterface) {
            $newUser = $provider->getOneById($oldUser->getId());
            $this->storage->setUser($newUser, $this->guard->getCurrentGuardName());
        }
    }

    /**
     * @return bool
     */
    public function isEventStoppingPropagation()
    {
        return false;
    }
}