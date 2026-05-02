<?php
declare(strict_types=1);

namespace Jadob\Auth\Identity;

use Jadob\Auth\AccessToken\AccessToken;
use Symfony\Component\HttpFoundation\Request;

/**
 * Determines which identity needs to be used for this request.
 */
interface IdentityPickerInterface
{
    /**
     * @param Request $request
     * @param array<AccessToken> $accessTokens
     * @return AccessToken
     */
    public function pick(Request $request, array $accessTokens): AccessToken;
}