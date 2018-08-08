<?php

namespace Jadob\Security\Auth\CredentialExtractor;
use Symfony\Component\HttpFoundation\Request;

/**
 * Using this one you can create an basic HTTP auth
 * @package Jadob\Security\Auth\CredentialExtractor
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class HttpBasicExtractor implements ExtractorInterface
{

    public function getCredentialsFromRequest(Request $request)
    {
        // TODO: Implement getCredentialsFromRequest() method.
    }
}