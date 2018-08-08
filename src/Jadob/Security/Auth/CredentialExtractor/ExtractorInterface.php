<?php

namespace Jadob\Security\Auth\CredentialExtractor;

use Symfony\Component\HttpFoundation\Request;

/**
 * Allows to extract auth data from request at your own way.
 * @package Jadob\Security\Auth\CredentialExtractor
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface ExtractorInterface
{
    public function getCredentialsFromRequest(Request $request);

}