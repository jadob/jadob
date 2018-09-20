<?php

namespace Jadob\Firewall;

/**
 * Class Firewall
 * @package Jadob\Firewall
 * @author pizzaminded <miki@appvende.net>
 */
class Firewall
{
    /**
     * @var FirewallRuleCollection
     */
    protected $ruleCollection;

    /**
     * Firewall constructor.
     * @param FirewallRuleCollection $ruleCollection
     */
    public function __construct(FirewallRuleCollection $ruleCollection)
    {
        $this->ruleCollection = $ruleCollection;
    }

    public function getFirewallRuleByName($name)
    {
        return $this
            ->ruleCollection
            ->get($name);
    }

    /**
     * Throws exception if there is no matching firewall rule.
     * @param string $path
     * @param string $method
     * @param array $rules
     */
    public function restrictAccess($path, $method, array $rules)
    {

    }

    /**
     * @return FirewallRuleCollection
     */
    public function getRuleCollection()
    {
        return $this->ruleCollection;
    }

    /**
     * @param FirewallRuleCollection $ruleCollection
     * @return Firewall
     */
    public function setRuleCollection($ruleCollection)
    {
        $this->ruleCollection = $ruleCollection;
        return $this;
    }

}