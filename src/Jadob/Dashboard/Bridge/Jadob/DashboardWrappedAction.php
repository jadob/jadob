<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Bridge\Jadob;


use DateTimeImmutable;
use Jadob\Core\RequestContext;
use Jadob\Dashboard\Action\DashboardAction;
use Symfony\Component\HttpFoundation\Response;

class DashboardWrappedAction
{
    protected DashboardAction $action;

    public function __construct(DashboardAction $action)
    {
        $this->action = $action;
    }

    public function __invoke(RequestContext $context): Response
    {

        $dashboardContext = new DashboardContext(
            DateTimeImmutable::createFromFormat(
                'U',
                (string)$context->getRequest()->server->get('REQUEST_TIME')
            ),
            $context->getUser()
        );

        return $this->action->__invoke($context->getRequest(), $dashboardContext);
    }

}