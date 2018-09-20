<?php

namespace Jadob\Firewall\Tests;

use Jadob\Firewall\Exception\FirewallBuilderException;
use Jadob\Firewall\Firewall;
use Jadob\Firewall\FirewallRule;
use Jadob\Firewall\StaticFirewallFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class FirewallFactoryTest
 * @package Jadob\Firewall\Tests
 * @testdox Firewall Builder test suite
 */
class FirewallFactoryTest extends TestCase
{

    /**
     * @return array
     */
    protected function getValidConfig()
    {
        return [
            'rules' =>  [
                'default' => [
                    'path' => '/(.*)',
                    'rules' => null //null allow any user to go here
                ]
            ]
        ];
    }


    /**
     * @throws FirewallBuilderException
     */
    public function testCannotBeCreatedFromEmptyConfigArray()
    {
        $this->expectException(FirewallBuilderException::class);

        StaticFirewallFactory::build([]);
    }

    /**
     * @throws FirewallBuilderException
     */
    public function testCannotBeCreatedFromInvalidConfigArray()
    {
        $this->expectException(FirewallBuilderException::class);

        $config = [
            'rules' => 'blah'
        ];

        StaticFirewallFactory::build($config);
    }

    /**
     * @throws FirewallBuilderException
     */
    public function testFirewallHasRulesDefinedInConfig()
    {
        $firewall = StaticFirewallFactory::build($this->getValidConfig());

        $this->assertInstanceOf(
            Firewall::class,
            $firewall,
            'Build valid firewall object'
        );

        $this->assertInstanceOf(
            FirewallRule::class,
            $firewall->getFirewallRuleByName('default'),
            'Has rule defined in config'
        );
    }
}