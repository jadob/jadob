<?php

namespace Jadob\Security\Firewall;

use Jadob\Security\Auth\User\UserInterface;
use Jadob\Security\Firewall\Exception\AccessDeniedException;
use Jadob\Security\Firewall\Rule\FirewallRule;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestMatcher;

/**
 * Class Firewall
 * @package Jadob\Security\Firewall
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Firewall
{
    /**
     * @var array[]
     */
    protected $config;

    /**
     * @var FirewallRule[]
     */
    protected $firewallRules = [];

    /**
     * @var ExcludedPath[]
     */
    protected $excludedPaths = [];

    /**
     * @var string|null
     */
    protected $currentFirewallRule;

    /**
     * Firewall constructor.
     * @param array $config
     * @throws \RuntimeException
     */
    public function __construct(array $config)
    {
//        r($config);
        $this->config = $config;

        if (isset($config['excluded_paths'])) {
            //@TODO: Make sure excluded_paths contains only instances of ExcludedPath
            $this->excludedPaths = $config['excluded_paths'];
        }

        if (isset($config['firewall_rules'])) {
            foreach ($config['firewall_rules'] as $firewallRuleKey => $firewallRuleArray) {
                $this->firewallRules[$firewallRuleKey] = FirewallRule::fromArray(
                    $firewallRuleArray,
                    $firewallRuleKey
                );
            }
        }
    }


    /**
     * Finds firewall rule by Request object.
     * @param Request $request
     * @return string|null returns rule name or null if no passed
     * @throws \Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException
     */
    public function matchRequest(Request $request)
    {
        //check if current path is excluded
        foreach ($this->excludedPaths as $excludedPath) {
            $matcher = new RequestMatcher($excludedPath->getPath());
            if ($matcher->matches($request)) {
                return null;
            }
        }

        //if current path is not excluded, check firewall rules
        foreach ($this->firewallRules as $ruleName => $firewallRule) {

            $host = $request->getHost();
            //if there is host passed in rule, use them
            if ($firewallRule->getHost() !== null) {
                $host = $firewallRule->getHost();
            }

            $matcher = new RequestMatcher(
                $firewallRule->getPath(),
                $host
            );

            if ($matcher->matches($request)) {
                return $ruleName;
            }
        }

        return null;
    }

    /**
     * Checks if user can go through given rule.
     *
     * @param string $ruleName
     * @param UserInterface|null $user
     * @throws AccessDeniedException
     */
    public function matchRuleToUser($ruleName, UserInterface $user = null)
    {
        if($ruleName === null) {
            return;
        }

        $rule = $this->firewallRules[$ruleName];

        if($user === null && $rule->getRoles() !== null) {
            throw new AccessDeniedException('User is not logged in.');
        }

    }

    /**
     * @return string|null
     */
    public function getCurrentFirewallRule()
    {
        return $this->currentFirewallRule;
    }

    /**
     * @param string|null $currentFirewallRule
     * @return Firewall
     */
    public function setCurrentFirewallRule($currentFirewallRule): Firewall
    {
        $this->currentFirewallRule = $currentFirewallRule;
        return $this;
    }


}