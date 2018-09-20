<?php
/**
 * Created by PhpStorm.
 * User: czajkowskimikolaj
 * Date: 2018-09-19
 * Time: 13:39
 */

namespace Jadob\Firewall;

class FirewallRuleCollection
{

    /**
     * @var FirewallRule[]
     */
    protected $rules;

    /**
     * @param FirewallRule $rule
     * @return $this
     */
    public function add(FirewallRule $rule)
    {
        $this->rules[$rule->getName()] = $rule;

        return $this;
    }

    /**
     * @param string $name
     * @return FirewallRule
     */
    public function get($name)
    {
        return $this->rules[$name];
    }
}