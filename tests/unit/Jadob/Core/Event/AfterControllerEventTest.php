<?php
declare(strict_types=1);

namespace Jadob\Core\Event;

use Jadob\Core\RequestContext;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AfterControllerEventTest extends TestCase
{
    public function testResponseOverriding(): void
    {
        $context = new RequestContext('test', Request::createFromGlobals());
        $originalResponse = new Response();
        $event = new AfterControllerEvent($originalResponse, $context);

        self::assertSame($originalResponse, $event->getResponse());

        $newResponse = new JsonResponse();
        $event->setResponse($newResponse);
        self::assertSame($newResponse, $event->getResponse());
    }
}