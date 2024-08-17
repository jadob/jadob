<?php
declare(strict_types=1);

namespace Jadob\Contracts\Dashboard;

interface ObjectManagerInterface
{
    public function handleCreate(object $object, DashboardContextInterface $context): void;
    public function handleUpdate(object $object, string $objectId, DashboardContextInterface $context): void;
}