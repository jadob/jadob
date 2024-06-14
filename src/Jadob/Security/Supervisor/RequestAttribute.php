<?php
declare(strict_types=1);

namespace Jadob\Security\Supervisor;

/**
 * @deprecated
 * Supervisor listeners appends these attributes to request object for use throughout the request.
 */
class RequestAttribute
{
    /**
     * Does current supervisor supports anonymous requests?
     * @var bool
     */
    public const SUPERVISOR_ANONYMOUS_ALLOWED = '_supervisor.anonymous.allowed';

    /**
     * Why User authentication went wrong?
     * This would not be an user-friendly content as exception message is passed here.
     * @var string
     */
    public const AUTHENTICATION_FAIL_REASON = '_supervisor.auth.fail_reason';
}