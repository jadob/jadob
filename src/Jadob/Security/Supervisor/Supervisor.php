<?php
declare(strict_types=1);

namespace Jadob\Security\Supervisor;

use Jadob\Security\Auth\UserProviderInterface;
use Jadob\Security\Supervisor\RequestSupervisor\RequestSupervisorInterface;
use Psr\Log\LoggerInterface;
use function spl_object_hash;
use Symfony\Component\HttpFoundation\Request;

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

    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Finds out which supervisor can handle given request.
     * @param Request $request
     * @return RequestSupervisorInterface|null
     */
    public function matchRequestSupervisor(Request $request): ?RequestSupervisorInterface
    {
        $pathName = $request->attributes->get('path_name');

        foreach ($this->requestSupervisors as $requestSupervisor) {
            if ($requestSupervisor->supports($request)) {
                $this->logger->debug(
                    sprintf('Path "%s" is supported by "%s" supervisor.', $pathName, get_class($requestSupervisor))
                );
                return $requestSupervisor;
            }
        }

        $this->logger->debug(sprintf('Path "%s" is not supported by any supervisor.', $pathName));
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