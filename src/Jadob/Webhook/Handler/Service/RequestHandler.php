<?php
declare(strict_types=1);

namespace Jadob\Webhook\Handler\Service;

use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

class RequestHandler
{
    public function __construct(
        protected EventDispatcherInterface $eventDispatcher
    ) {
    }


    public function handle(Request $request)
    {
    }
}