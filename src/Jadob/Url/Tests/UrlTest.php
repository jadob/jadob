<?php
declare(strict_types=1);

namespace Jadob\Url\Tests;

use Jadob\Url\Url;
use Monolog\Test\TestCase;

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

}