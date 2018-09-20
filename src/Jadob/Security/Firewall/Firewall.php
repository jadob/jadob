<?php

namespace Jadob\Security\Firewall;

use Jadob\Security\Auth\AuthenticationManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @deprecated
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
     * @var string[]
     */
    protected $excludedRoutePatterns;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Firewall constructor.
     * @param AuthenticationManager $manager
     * @param array $config
     */
    public function __construct(AuthenticationManager $manager, array $config, LoggerInterface $logger)
    {
        $this->manager = $manager;
        $this->config = $config;
        $this->logger = $logger;
        $this->excludedRoutePatterns = $config['exclude'] ?? [];

        $this->buildRules();

    }

    protected function buildRules()
    {
        foreach ($this->config['rules'] as $ruleName => $ruleData) {

            $rule = new FirewallRule($ruleName);


            if ($this->manager->getAuthenticationRuleByName($ruleData['auth_rule']) === null) {
                throw new \RuntimeException('Auth rule called ' . $ruleData['auth_rule'] . ' does not exists.');
            }

            $rule->setAccessDeniedController($ruleData['access_denied_controller'] ?? null);
            $rule->setAuthenticationRule($ruleData['auth_rule']);
            $rule->setRoutePattern($ruleData['route_pattern']);
            $rule->setRoles($ruleData['roles']);

            $this->rules[$ruleName] = $rule;
            unset($rule, $authRule);
        }
    }

    /**
     * @deprecated
     * Matches only request URI.
     * @param Request $request
     * @return FirewallRule|null
     */
    public function getMatchingRouteByRequest(Request $request)
    {
        foreach ($this->rules as $rule) {

            if ($this->matchPath($rule->getPattern(), $request->getPathInfo())) {
                return $rule;
            }

        }

        return null;
    }

    /**
     * Here we check ANYTHING.
     * We pass rule we found earlier and current request.
     * If user will be needed we will take it from firewall constructor.
     *
     * @deprecated
     * @param FirewallRule $rule
     * @param Request $request
     * @return bool
     */
    public function matchRule(FirewallRule $rule, Request $request)
    {

        //path does not matches
        if ($this->matchPath($rule->getPattern(), $request->getPathInfo())) {
            return false;
        }


        //but after all...
        $roles = array_intersect(
            $rule->getRoles(),
            $this->manager->getUserStorage()->getUser()->getRoles()
        );

        return \count($roles) > 0;
    }

    /**
     * @deprecated
     * @param $pattern
     * @param $path
     * @return bool
     */
    protected function matchPath($pattern, $path)
    {
        $pattern = '#^' . $pattern . '$#';

        return (bool)preg_match($pattern, $path);

    }

    /**
     * @return FirewallRule[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param FirewallRule[] $rules
     * @return Firewall
     */
    public function setRules(array $rules): Firewall
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getExcludedRoutePatterns(): array
    {
        return $this->excludedRoutePatterns;
    }

    /**
     * @param string[] $excludedRoutePatterns
     * @return Firewall
     */
    public function setExcludedRoutePatterns(array $excludedRoutePatterns): Firewall
    {
        $this->excludedRoutePatterns = $excludedRoutePatterns;
        return $this;
    }

}