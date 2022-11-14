<?php
declare(strict_types=1);

namespace Jadob\Router;

use Jadob\Router\Exception\RouterException;
use PHPUnit\Framework\TestCase;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ContextTest extends TestCase
{

    public function testBasicContextFeatures(): void
    {
        $context = new Context();

        $context->setSecure(true);
        $context->setPort(1234);
        $context->setHost('example.com');

        self::assertTrue($context->isSecure());
        self::assertEquals('example.com', $context->getHost());
        self::assertEquals(1234, $context->getPort());
    }

    public function testCreatingContextObjectFromSuperglobalArrays(): void
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com';
        $_SERVER['HTTPS'] = true;
        $_SERVER['SERVER_PORT'] = '8001';


        $context = Context::fromGlobals();

        self::assertTrue($context->isSecure());
        self::assertEquals('my.domain.com', $context->getHost());
        self::assertEquals(8001, $context->getPort());
    }

    public function testCheckingHttpHostHasAColon(): void
    {
        $_SERVER['HTTP_HOST'] = 'my.domain.com:8001';
        $_SERVER['HTTPS'] = true;
        $_SERVER['REQUEST_URI'] = '/';

        $context = Context::fromGlobals();

        self::assertTrue($context->isSecure());
        self::assertEquals('my.domain.com', $context->getHost());
        self::assertEquals(8001, $context->getPort());
    }

    public function testFromBaseUrlWithProtocolAndHostnameAndCustomPort(): void
    {
        $context = Context::fromBaseUrl('https://evil.corp:1234');

        self::assertTrue($context->isSecure());
        self::assertEquals(1234, $context->getPort());
        self::assertEquals('evil.corp', $context->getHost());
    }


    public function testFromBaseUrlWithProtocolAndHostnameAndBasePath(): void
    {
        $context = Context::fromBaseUrl('https://evil.corp/_hello');

        self::assertEquals('evil.corp', $context->getHost());
        self::assertEquals('/_hello', $context->getAlias());
    }


    public function testFromBaseUrlWithInvalidPayload(): void
    {
        $this->expectException(RouterException::class);
        $this->expectExceptionMessage('Unable to create context from base url: Missing hostname');

        Context::fromBaseUrl('this definitely is not an url');
    }
}