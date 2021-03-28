<?php
declare(strict_types=1);

namespace Jadob\Security\Supervisor;

/**
 * Supervisor listeners appends these attributes to request for internal use throughout the request.
 */
class RequestAttribute
{
    public const SUPERVISOR_ANONYMOUS_ALLOWED = '_supervisor.anonymous.allowed';
}