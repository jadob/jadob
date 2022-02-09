<?php
declare(strict_types=1);

namespace Jadob\Dashboard\SingleObjectOperation;

use Jadob\Core\RequestContext;
use Jadob\Dashboard\Configuration\ManagedObject;
use Symfony\Component\HttpFoundation\Response;

/**
 * @license MIT
 */
interface SingleObjectOperationInterface
{
    public function handle(
        RequestContext $context,
        ManagedObject $object,
        ?string $objectId
    ): Response;

    /**
     * When false returned, an exception will be raised when there will be no id in request.
     * @return bool
     */
    public function allowsNullObjectId(): bool;
}