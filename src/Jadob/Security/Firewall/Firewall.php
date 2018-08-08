<?php

namespace Jadob\Security\Firewall;

use Jadob\Security\Auth\AuthenticationManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Watches your requests and blocks them if needed.
 * @package Jadob\Security\Firewall
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Firewall
{

    /**
     * @var AuthenticationManager
     */
    protected $manager;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var FirewallRule[]
     */
    protected $rules;

    /**
     * Firewall constructor.
     * @param AuthenticationManager $manager
     * @param array $config
     */
    public function __construct(AuthenticationManager $manager, array $config)
    {
        $this->manager = $manager;
        $this->config = $config;

        $this->buildRules();
    }

    protected function buildRules()
    {
        foreach ($this->config['rules'] as $ruleName => $ruleData) {
            $rule = new FirewallRule($ruleName);

            if (($authRule = $this->manager->getAuthenticationRuleByName($ruleData['auth_rule'])) === null) {
                throw new \RuntimeException('Auth rule called ' . $ruleData['auth_rule'] . ' does not exists.');
            }

            $rule->setAuthenticationRule($authRule);
            $rule->setPattern($ruleData['pattern']);
            $rule->setRoles($ruleData['roles']);


            $this->rules[$ruleName] = $rule;
            unset($rule, $authRule);
        }
    }

    /**
     * Matches only request URI.
     * @param Request $request
     * @return FirewallRule|null
     */
    public function getMatchingRouteByRequest(Request $request)
    {
        foreach ($this->rules as $rule) {

            $pattern = '#^' . $rule->getPattern() . '$#';

            if ((bool)preg_match($pattern, $request->getPathInfo())) {
                return $rule;
            }
        }

        return null;
    }

    /**
     * Here we check ANYTHING.
     * We pass rule we found earlier and current request.
     * If user will be needed we will take it from firewall constructor.
     */
    public function matchRule(FirewallRule $rule, Request $request)
    {


    }

}