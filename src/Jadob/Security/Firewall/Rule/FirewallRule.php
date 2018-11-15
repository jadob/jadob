<?php

namespace Jadob\Security\Firewall\Rule;

/**
 * Class FirewallRule
 * @package Jadob\Security\Firewall\Rule
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 * @deprecated
 */
class FirewallRule implements FirewallRuleInterface
{

    /**
     * @var bool
     */
    protected $stateless = false;

    /**
     * @var null|string
     */
    protected $host;

    /**
     * @var string
     */
    protected $path;

    protected $roles;

    /**
     * {@inheritdoc}
     */
    public function isStateless(): bool
    {
        return $this->stateless;
    }

    /**
     * @return null|string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param null|string $host
     * @return FirewallRule
     */
    public function setHost($host): FirewallRule
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return FirewallRule
     */
    public function setPath($path): FirewallRule
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     * @return FirewallRule
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @param array $data
     * @param null|string $name
     * @return FirewallRule
     * @throws \RuntimeException
     */
    public static function fromArray(array $data, $name = null)
    {
        if (!isset($data['path'])) {
            throw new \RuntimeException('Firewall rule "' . $name . '" does not contain "path" key.');
        }

        $object = new self();
        $object
            ->setPath($data['path'])
            ->setHost($data['host'] ?? null)
            ->setRoles($data['roles'] ?? null);

        return $object;

    }
}