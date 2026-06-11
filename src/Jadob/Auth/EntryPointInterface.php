<?php
declare(strict_types=1);

namespace Jadob\Auth;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface EntryPointInterface
{
    /**
     * Called when no authenticators in firewall are supporting the request.
     * You can redirect user to login or return unauthenticated api user here.
     * @param Request $request
     * @return Response
     */
    public function commence(Request $request): Response;
}