<?php
declare(strict_types=1);

namespace Jadob\Security\Supervisor;

use Jadob\Security\Auth\Exception\InvalidCredentialsException;
use Jadob\Security\Supervisor\RequestSupervisor\RequestSupervisorInterface;
use Symfony\Component\HttpFoundation\Request;
use function str_replace;
use function trim;

/**
 * Provides some helper methods for improving authentication process.
 * @license MIT
 */
abstract class AbstractStatelessSupervisor implements RequestSupervisorInterface
{

    /**
     * @param Request $request
     * @param string $tokenName
     * @throws InvalidCredentialsException
     */
    protected function assertTokenHeaderPresence(Request $request, string $tokenName = 'Authorization'): void
    {
        if (!$request->headers->has($tokenName)) {
            throw new InvalidCredentialsException('Missing credentials');
        }

    }

    protected function getBearerTokenFromRequest(Request $request): string
    {
        $rawHeader = $request->headers->get('Authorization');
        return trim(str_replace('Bearer', '', (string)$rawHeader));
    }
}