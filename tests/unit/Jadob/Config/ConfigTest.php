<?php

declare(strict_types=1);

namespace Jadob\Config;

use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testSimpleConfigNodesLoading(): void
    {
        $config = new Config();

        $config->loadDirectory(__DIR__ . '/includes/1');
        self::assertFalse($config->hasNode('default_config_file.php'));
    }


    public function testConfigWillBreakIfNoNodeFound(): void
    {
        $this->expectExceptionMessage('Could not find node "missing".');
        $this->expectException(Exception\ConfigNodeNotFoundException::class);
        $config = new Config();

        $config->loadDirectory(__DIR__ . '/includes/1');
        $config->getNode('missing');
    }


    public function testParameterPassing(): void
    {
        $config = new Config();

        $config->loadDirectory(
            __DIR__ . '/includes/2', [], 1, [
                'bax' => 'bax',
                'baz' => 'baz'
            ]
        );

        $node =  $config->getNode('with_parameter');
        self::assertEquals('bax', $node['bax']);
        self::assertEquals('baz', $node['bar']);
    }
}