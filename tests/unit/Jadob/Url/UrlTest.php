<?php
declare(strict_types=1);

namespace Jadob\Url;

use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    public function testBasicUrlDisassembling(): void
    {
        $url = new Url('https://github.com');

        self::assertSame('https', $url->getScheme());
        self::assertSame('github.com', $url->getHost());
        self::assertNull($url->getPath());
        self::assertSame(null, $url->getPort());
    }

    public function testQueryProcessing()
    {
        $url = new Url('https://example.com?key1=val1&key2[]=val2');

        self::assertSame(
            [
                'key1' => 'val1',
                'key2' => ['val2']
            ],
            $url->getQuery()
        );

    }

    public function testUrlWillSkipAttachingDefaultPortToHttpUrl(): void
    {
        $url = new Url();
        $url->setScheme('http');
        $url->setHost('example.com');
        $url->setPort(80);
        $url->setPath('/a/b/c');

        self::assertSame(
            'http://example.com/a/b/c',
            $url->build()
        );
    }

    public function testUrlWillSkipAttachingDefaultPortToHttpsUrl(): void
    {
        $url = new Url();
        $url->setScheme('https');
        $url->setHost('example.com');
        $url->setPort(443);
        $url->setPath('/a/b/c');

        self::assertSame(
            'https://example.com/a/b/c',
            $url->build()
        );
    }

    public function testUrlWillAttachHttpPortToHttpsUrl(): void
    {
        $url = new Url();
        $url->setScheme('https');
        $url->setHost('example.com');
        $url->setPort(80);
        $url->setPath('/a/b/c');

        self::assertSame(
            'https://example.com:80/a/b/c',
            $url->build()
        );
    }

    public function testUrlWillAttachHttpsPortToHttpUrl(): void
    {
        $url = new Url();
        $url->setScheme('http');
        $url->setHost('example.com');
        $url->setPort(443);
        $url->setPath('/a/b/c');

        self::assertSame(
            'http://example.com:443/a/b/c',
            $url->build()
        );
    }
}