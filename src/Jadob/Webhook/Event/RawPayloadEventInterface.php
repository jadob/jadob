<?php
declare(strict_types=1);

namespace Jadob\Webhook\Event;

/**
 * When implemented, an event can return a plain text event content.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface RawPayloadEventInterface
{
    /**
     * Returns a plaintext webhook body.
     * @return string
     */
    public function getRawPayload(): string;
}