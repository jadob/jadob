<?php

namespace Jadob\Security\Firewall\Rule;

/**
 * Interface FirewallRuleInterface
 * @package Jadob\Security\Firewall\Rule
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 * @deprecated
 */
interface FirewallRuleInterface
{

    /**
     * @return bool
     */
    public function isStateless();
}