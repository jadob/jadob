<?php
declare(strict_types=1);

namespace Jadob\Auth;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface EntryPointInterface
{
    public function commence(Request $request): Response;
}