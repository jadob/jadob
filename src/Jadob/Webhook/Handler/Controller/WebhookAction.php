<?php
declare(strict_types=1);

namespace Jadob\Webhook\Handler\Controller;


use Jadob\Webhook\Handler\Service\RequestHandler;
use Symfony\Component\HttpFoundation\Request;

class WebhookAction
{

    public function __invoke(
        Request $request,
        RequestHandler $requestHandler
    )
    {
        $requestHandler->handle($request);
    }

}