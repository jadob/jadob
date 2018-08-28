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
    protected $routePattern;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string[]
     */
    protected $roles;

    /**
     * @var string
     */
    protected $authenticationRule;

    /**
     * @var string
     */
    protected $accessDeniedController;

    /**
     * FirewallRule constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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
     * @return string[]
     */
    public function getRoles()
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
     * @return string
     */
    public function getAuthenticationRule()
    {
        return $this->authenticationRule;
    }

    /**
     * @param string $authenticationRule
     * @return FirewallRule
     */
    public function setAuthenticationRule($authenticationRule): FirewallRule
    {
        $this->authenticationRule = $authenticationRule;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getRoutePattern(): ?string
    {
        return $this->routePattern;
    }

    /**
     * @param null|string $routePattern
     * @return FirewallRule
     */
    public function setRoutePattern(?string $routePattern): FirewallRule
    {
        $this->routePattern = $routePattern;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessDeniedController()
    {
        return $this->accessDeniedController;
    }

    /**
     * @param string $accessDeniedController
     * @return FirewallRule
     */
    public function setAccessDeniedController($accessDeniedController): FirewallRule
    {
        $this->accessDeniedController = $accessDeniedController;
        return $this;
    }

}