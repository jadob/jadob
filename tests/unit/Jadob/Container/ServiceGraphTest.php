<?php

namespace Jadob\Container;

use PHPUnit\Framework\TestCase;

class ServiceGraphTest extends TestCase
{
    private ServiceGraph $graph;

    protected function setUp(): void
    {
        $this->graph = new ServiceGraph();
    }

    public function testCheckingForParameterPresence(): void
    {
        self::assertFalse($this->graph->hasParameter("foo"));
        $this->graph->addParameter("foo", "bar");
        self::assertTrue($this->graph->hasParameter("foo"));
    }

}