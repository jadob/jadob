<?php
declare(strict_types=1);

namespace Jadob\Security\Supervisor;

use Jadob\Security\Auth\UserProviderInterface;
use Jadob\Security\Supervisor\RequestSupervisor\RequestSupervisorInterface;
use Symfony\Component\HttpFoundation\Request;
use function spl_object_hash;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Supervisor
{
    /**
     * @var RequestSupervisorInterface[]
     */
    protected array $requestSupervisors = [];

    /**
     * @var UserProviderInterface[]
     */
    protected array $userProviders = [];

    /**
     * Finds out which supervisor can handle given request.
     * @param  Request $request
     * @return RequestSupervisorInterface|null
     */
    public function matchRequestSupervisor(Request $request): ?RequestSupervisorInterface
    {
        foreach ($this->requestSupervisors as $requestSupervisor) {
            if ($requestSupervisor->supports($request)) {
                return $requestSupervisor;
            }
        }

        return null;
    }

    //@todo refactor
    public function addRequestSupervisor(string $name, RequestSupervisorInterface $requestSupervisor, UserProviderInterface $userProvider): void
    {
        $this->requestSupervisors[$name] = $requestSupervisor;
        $this->userProviders[spl_object_hash($requestSupervisor)] = $userProvider;
    }

    //@TODO refactor
    public function getUserProviderForSupervisor(RequestSupervisorInterface $supervisor): UserProviderInterface
    {
        return $this->userProviders[spl_object_hash($supervisor)];
    }

}