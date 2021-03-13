<?php
declare(strict_types=1);

namespace Jadob\Dashboard;


class DashboardContext
{

    protected \DateTimeInterface $requestDateTime;

    public function __construct(\DateTimeInterface $requestDateTime)
    {
        $this->requestDateTime = $requestDateTime;
    }

    public function getRequestDateTime(): \DateTimeInterface
    {
        return $this->requestDateTime;
    }
}