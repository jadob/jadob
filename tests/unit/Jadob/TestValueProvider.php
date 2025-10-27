<?php

namespace Jadob;

use Jadob\Core\RequestContext;
use Symfony\Component\HttpFoundation\Request;

class TestValueProvider
{

    public static function requestContext(
        string $path = '/',
        string $method = 'GET'
    ): RequestContext
    {
        return new RequestContext(
            'test',
            Request::create($path, $method)
        );
    }

}