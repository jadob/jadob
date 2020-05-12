<?php
declare(strict_types=1);

namespace Jadob\Core\Tests\Event;


use Jadob\Core\Event\AfterControllerEvent;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AfterControllerEventTest extends TestCase
{

    public function testResponseOverriding()
    {
        $orginalResponse = new Response();
        $event = new AfterControllerEvent($orginalResponse);

        $this->assertSame($orginalResponse, $event->getResponse());

        $newResponse = new JsonResponse();
        $event->setResponse($newResponse);
        $this->assertSame($newResponse, $event->getResponse());
    }
}