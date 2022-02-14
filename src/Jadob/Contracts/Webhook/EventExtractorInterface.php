<?php

declare(strict_types=1);

namespace Jadob\Contracts\Webhook;

use Symfony\Component\HttpFoundation\Request;

interface EventExtractorInterface
{
    /**
     * Checks if request contains any legitimate payload that can be later extracted into an event class.
     */
    public function canProcess(Request $request): bool;

    public function extractEvent(Request $request): object;
}
