<?php

namespace Jadob\Security\Auth\MultiFactorAuthentication;

use Symfony\Component\HttpFoundation\Response;

interface ChallengeInterface
{

    /**
     * Generates a page will challenge which user needs to respond in order to continue.
     * @param ChallengeStoreService $storeService
     * @return Response
     */
    public function challenge(
        ChallengeStoreService $storeService
    ): Response;



    public function handleUserResponse(
        ChallengeStoreService $storeService
    );
}