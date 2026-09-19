<?php
declare(strict_types=1);

namespace Jadob;

use Jadob\Core\RequestContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class TestValueProvider
{
    public static function requestContext(
        string $path = '/',
        string $method = 'GET'
    ): RequestContext {
        $request = Request::create($path, $method);
        $request->setSession(new Session(new MockArraySessionStorage()));

        return new RequestContext(
            'test',
            $request,
        );
    }
}