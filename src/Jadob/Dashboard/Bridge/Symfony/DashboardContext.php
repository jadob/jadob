<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Bridge\Symfony;


use DateTimeInterface;
use Jadob\Contracts\Dashboard\DashboardContextInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardContext implements DashboardContextInterface
{


    protected DateTimeInterface $requestDateTime;
    protected UserInterface $user;

    public function __construct(
        DateTimeInterface $requestDateTime,
        UserInterface $user
    )
    {
        $this->requestDateTime = $requestDateTime;
        $this->user = $user;
    }

    public function hasRole(string $roleName): bool
    {
        foreach ($this->user->getRoles() as $role) {
            if((string)$role === $roleName) {
                return true;
            }
        }

        return false;
    }

    public function getRequestDateTime(): DateTimeInterface
    {
        return $this->requestDateTime;
    }
}