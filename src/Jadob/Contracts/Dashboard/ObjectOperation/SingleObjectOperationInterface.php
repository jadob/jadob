<?php
declare(strict_types=1);

namespace Jadob\Contracts\Dashboard\ObjectOperation;

use Jadob\Contracts\Dashboard\DashboardContextInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * @license MIT
 */
interface SingleObjectOperationInterface
{
    public function handle(
        DashboardContextInterface $context,
        object $object,
        ?string $objectId
    ): Response;

    /**
     * When false returned, an exception will be raised when there will be no id in request.
     * @return bool
     */
    public function allowsNullObjectId(): bool;
}