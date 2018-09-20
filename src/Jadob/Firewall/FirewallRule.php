<?php

namespace Jadob\Firewall;

class FirewallRule
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $pathRegex;

    /**
     * Empty array means that any role is allowed.
     * @var array
     */
    protected $roles = [];

    /**
     * Empty array means that any method is allowed.
     * @var array
     */
    protected $methods = [];


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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return FirewallRule
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPathRegex()
    {
        return $this->pathRegex;
    }

    /**
     * @param string $pathRegex
     * @return FirewallRule
     */
    public function setPathRegex($pathRegex)
    {
        $this->pathRegex = $pathRegex;
        return $this;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return FirewallRule
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return array
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     * @return FirewallRule
     */
    public function setMethods($methods)
    {
        $this->methods = $methods;
        return $this;
    }
}