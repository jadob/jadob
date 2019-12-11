<?php

namespace Jadob\Config\Tests;

use Jadob\Config\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testSimpleConfigNodesLoading()
    {
        $config = new Config();

        $config->loadDirectory(__DIR__ . '/includes/1');
        $this->assertIsArray($config->getNode('default_config_file'));
        $this->assertFalse($config->hasNode('default_config_file.php'));
    }

    /**
     * @expectedException        \Jadob\Config\Exception\ConfigNodeNotFoundException
     * @expectedExceptionMessage Could not find node "missing".
     */
    public function testConfigWillBreakIfNoNodeFound()
    {
        $config = new Config();

        $config->loadDirectory(__DIR__ . '/includes/1');
        $config->getNode('missing');
    }


    public function testParameterPassing()
    {
        $config = new Config();

        $config->loadDirectory(
            __DIR__ . '/includes/2', [], 1, [
            'bax' => 'bax',
            'baz' => 'baz'
            ]
        );

        $node =  $config->getNode('with_parameter');
        $this->assertEquals('bax', $node['bax']);
        $this->assertEquals('baz', $node['bar']);
    }

}