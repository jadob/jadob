<?php

namespace Jadob\Security\Auth\CredentialExtractor;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultExtractor
 * @package Jadob\Security\Auth\CredentialExtractor
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DefaultExtractor implements ExtractorInterface
{

    public function getCredentialsFromRequest(Request $request)
    {
        // TODO: Implement getCredentialsFromRequest() method.
    }
}