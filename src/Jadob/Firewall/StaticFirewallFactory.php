<?php

namespace Jadob\Firewall;

use Jadob\Firewall\Exception\FirewallBuilderException;

/**
 * Class StaticFirewallFactory
 * @package Jadob\Firewall
 * @author pizzaminded <miki@appvende.net>
 */
class StaticFirewallFactory
{
    /**
     * @param array $config
     * @return Firewall
     * @throws FirewallBuilderException
     */
    public static function build(array $config)
    {
        self::validateConfigArray($config);

        $ruleCollection = self::buildRuleCollection($config['rules']);

        return new Firewall($ruleCollection);
    }

    /**
     * Checks if config array is valid
     * @param array $config
     * @throws FirewallBuilderException
     */
    protected static function validateConfigArray($config)
    {
        if(!isset($config['rules'])) {
            throw new FirewallBuilderException('Firewall configuration does not contain "rules" section.');
        }

        if(!\is_array($config['rules']) || \count($config['rules']) === 0) {
            throw new FirewallBuilderException('Firewall configuration is invalid: key "rules" is empty or not an array');
        }
    }

    /**
     * @param array $rules
     * @return FirewallRuleCollection
     */
    protected static function buildRuleCollection(array $rules)
    {

        $collection = new FirewallRuleCollection();

        foreach ($rules as $ruleName => $rule) {
            $rule = new FirewallRule($ruleName);
            $collection->add($rule);

            unset($rule);
        }

        return $collection;
    }
}