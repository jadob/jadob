<?php

namespace Jadob\Firewall\Tests;

use Jadob\Firewall\StaticFirewallFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class FirewallTest
 * @package Jadob\Firewall\Tests
 * @testdox Firewall object test suite
 */
class FirewallTest extends TestCase
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
     * @throws \Jadob\Firewall\Exception\FirewallBuilderException
     */
    public function testFirewallCanDenyAccess()
    {
        $firewall = StaticFirewallFactory::build($this->getValidConfig());

    }

}