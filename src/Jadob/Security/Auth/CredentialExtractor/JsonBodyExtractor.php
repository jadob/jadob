<?php

namespace Jadob\Security\Auth\CredentialExtractor;

use Jadob\Security\Auth\Token;
use Symfony\Component\HttpFoundation\Request;

class JsonBodyExtractor implements ExtractorInterface
{

    public function getCredentialsFromRequest(Request $request)
    {
        if ($request->getMethod() !== 'POST') {
            return null;
        }

        $content = $request->getContent();

        if ($content === '') {
            return null;
        }

        $contentDecoded = \json_decode($content, true);

        if (isset($contentDecoded['username'], $contentDecoded['password'])) {
            return new Token($contentDecoded['username'], $contentDecoded['password']);
        }

        return null;
    }
}