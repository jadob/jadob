<?php
declare(strict_types=1);

namespace Jadob\Core\Tests\Event;


use Jadob\Core\Event\AfterControllerEvent;
use Jadob\Core\RequestContext;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AfterControllerEventTest extends TestCase
{

    public function testResponseOverriding()
    {
        $context = new RequestContext('test', Request::createFromGlobals(), false);
        $orginalResponse = new Response();
        $event = new AfterControllerEvent($orginalResponse, $context);

        $this->assertSame($orginalResponse, $event->getResponse());

        $newResponse = new JsonResponse();
        $event->setResponse($newResponse);
        $this->assertSame($newResponse, $event->getResponse());
    }
}