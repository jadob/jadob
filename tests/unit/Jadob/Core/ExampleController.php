<?php

namespace Jadob\Core;


use Symfony\Component\HttpFoundation\Response;

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