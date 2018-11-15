<?php

namespace Jadob\Security\Firewall\EventListener;

use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;
use Jadob\Security\Auth\UserStorage;
use Jadob\Security\Firewall\Firewall;

/**
 * Checks that user can access requested resource
 * @package Jadob\Security\Auth\EventListener
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 * @deprecated
 */
class AuthCheckListener implements BeforeControllerEventListenerInterface
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
     * AuthCheckListener constructor.
     * @param Firewall $firewall
     * @param UserStorage $storage
     */
    public function __construct(Firewall $firewall, UserStorage $storage)
    {
        $this->firewall = $firewall;
        $this->storage = $storage;
    }

    /**
     * {@inheritdoc}
     */
    public function onBeforeControllerInterface(BeforeControllerEvent $event): void
    {
        //if there is no firewall rule matched, there is no reason to restrict access
        if(($firewallRule = $this->firewall->getCurrentFirewallRule()) === null) {
            return;
        }

        $user = $this->storage->getUser();

        r($firewallRule);
        $this->firewall->matchRuleToUser($firewallRule, $user);

        die('mimo to powinienenm coś zrobić');
    }

    /**
     * {@inheritdoc}
     */
    public function isEventStoppingPropagation(): bool
    {
        return false;
    }
}