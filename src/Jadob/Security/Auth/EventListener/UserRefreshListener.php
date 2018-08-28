<?php

namespace Jadob\Security\Auth\EventListener;

use Jadob\EventListener\Event\AfterRouterEvent;
use Jadob\EventListener\Event\Type\AfterRouterListenerInterface;
use Jadob\Security\Auth\AuthenticationManager;

/**
 * Class UserRefreshListener
 * @package Jadob\Security\Auth\Event
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class UserRefreshListener implements AfterRouterListenerInterface
{

    /**
     * @var AuthenticationManager
     */
    protected $manager;


    /**
     * AuthListener constructor.
     * @param AuthenticationManager $manager
     */
    public function __construct(AuthenticationManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return bool
     */
    public function isEventStoppingPropagation()
    {
        return false;
    }

    /**
     * @param AfterRouterEvent $event
     */
    public function onAfterRouterAction(AfterRouterEvent $event)
    {
        $userObject = $this->manager->getUserStorage()->getUser();

        if ($userObject === null) {
            return;
        }

        if ($userObject->userNeedsRefreshing()) {
            $this->manager->updateUserFromStorage();
        }
    }
}