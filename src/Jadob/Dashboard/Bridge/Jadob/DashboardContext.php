<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Bridge\Jadob;

use DateTimeInterface;
use Jadob\Contracts\Dashboard\DashboardContextInterface;
use Jadob\Security\Auth\User\UserInterface;

class DashboardContext implements DashboardContextInterface
{

    protected DateTimeInterface $requestDateTime;

    protected UserInterface $user;

    public function __construct(DateTimeInterface $requestDateTime, UserInterface $user)
    {
        $this->requestDateTime = $requestDateTime;
        $this->user = $user;
    }

    public function getRequestDateTime(): DateTimeInterface
    {
        return $this->requestDateTime;
    }

    public function hasRole(string $roleName): bool
    {
        foreach ($this->user->getRoles() as $role) {
            if($role === $roleName) {
                return true;
            }
        }

        return false;
    }
}