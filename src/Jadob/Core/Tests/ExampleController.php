<?php

namespace Jadob\Core\Tests;


use Symfony\Component\HttpFoundation\Response;

/**
 * @internal
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 */
class ExampleController
{
    /**
     * @return Response
     */
    public function __invoke()
    {
        return new Response('ok');
    }

}