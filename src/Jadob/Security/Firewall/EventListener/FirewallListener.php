<?php

namespace Jadob\Security\Firewall\EventListener;

use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;
use Jadob\Security\Auth\UserStorage;
use Jadob\Security\Firewall\Firewall;

/**
 * Class FirewallListener
 * @package Jadob\Security\Firewall\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 * @deprecated
 */
class FirewallListener implements BeforeControllerEventListenerInterface
{
    /**
     * @var Firewall
     */
    protected $firewall;

    /**
     * @var UserStorage
     */
    protected $storage;

    /**
     * FirewallListener constructor.
     * @param Firewall $firewall
     * @param UserStorage $storage
     */
    public function __construct(Firewall $firewall, UserStorage $storage)
    {
        $this->firewall = $firewall;
        $this->storage = $storage;
    }

    /**
     * @param BeforeControllerEvent $event
     * @return void
     * @throws \Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException
     */
    public function onBeforeControllerInterface(BeforeControllerEvent $event): void
    {

//        die('ja sie kurwa wykonałem');

        $firewallRule = $this->firewall->matchRequest($event->getRequest());
        $this->firewall->setCurrentFirewallRule($firewallRule);
        $this->storage->setFirewallRuleName($firewallRule);
    }

    /**
     * @return bool
     */
    public function isEventStoppingPropagation()
    {
        return false;
    }
}