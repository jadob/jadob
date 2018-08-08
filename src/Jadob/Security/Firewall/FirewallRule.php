<?php

namespace Jadob\Security\Firewall;
use Jadob\Security\Auth\AuthenticationRule;

/**
 * Class FirewallRule
 * @package Jadob\Security\Firewall
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FirewallRule
{

    /**
     * @var string|null
     */
    protected $pathWildcard;

    /**
     * @var string|null
     */
    protected $routeWildcard;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $pattern;

    /**
     * @var string[]
     */
    protected $roles;

    /**
     * @var AuthenticationRule
     */
    protected $authenticationRule;

    /**
     * FirewallRule constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getPathWildcard(): string
    {
        return $this->pathWildcard;
    }

    /**
     * @param null|string $pathWildcard
     * @return FirewallRule
     */
    public function setPathWildcard(string $pathWildcard): FirewallRule
    {
        $this->pathWildcard = $pathWildcard;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getRouteWildcard(): string
    {
        return $this->routeWildcard;
    }

    /**
     * @param null|string $routeWildcard
     * @return FirewallRule
     */
    public function setRouteWildcard(string $routeWildcard): FirewallRule
    {
        $this->routeWildcard = $routeWildcard;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return FirewallRule
     */
    public function setName(string $name): FirewallRule
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     * @return FirewallRule
     */
    public function setPattern(string $pattern): FirewallRule
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param string[] $roles
     * @return FirewallRule
     */
    public function setRoles(array $roles): FirewallRule
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return AuthenticationRule
     */
    public function getAuthenticationRule(): AuthenticationRule
    {
        return $this->authenticationRule;
    }

    /**
     * @param AuthenticationRule $authenticationRule
     * @return FirewallRule
     */
    public function setAuthenticationRule(AuthenticationRule $authenticationRule): FirewallRule
    {
        $this->authenticationRule = $authenticationRule;
        return $this;
    }

}