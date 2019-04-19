<?php

namespace Jadob\Router\Tests;

use Jadob\Router\Context;
use PHPUnit\Framework\TestCase;

/**
 * Class ContextTest
 * @package Jadob\Router\Tests
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ContextTest extends TestCase
{

    public function testBasicContextFeatures()
    {
        $context = new Context();

        $context->setSecure(true);
        $context->setPort(1234);
        $context->setHost('example.com');

        $this->assertTrue($context->isSecure());
        $this->assertEquals('example.com', $context->getHost());
        $this->assertEquals(1234, $context->getPort());
    }

    public function testCreatingContextObjectFromSuperglobalArrays()
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['HTTPS'] = true;
        $_SERVER['SERVER_PORT'] = 8001;


        $context = Context::fromGlobals();

        $this->assertTrue($context->isSecure());
        $this->assertEquals('my.domain.com', $context->getHost());
        $this->assertEquals(8001, $context->getPort());
    }

    public function testCheckingHttpHostHasAColon()
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com:8001';
        $_SERVER['HTTPS'] = true;

        $context = Context::fromGlobals();

        $this->assertTrue($context->isSecure());
        $this->assertEquals('my.domain.com', $context->getHost());
        $this->assertEquals(8001, $context->getPort());
    }
}