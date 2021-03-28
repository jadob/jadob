<?php
declare(strict_types=1);

namespace Jadob\Contracts\Dashboard;


interface DashboardContextInterface
{
    public function hasRole(string $roleName): bool;
    public function getRequestDateTime(): \DateTimeInterface;

}