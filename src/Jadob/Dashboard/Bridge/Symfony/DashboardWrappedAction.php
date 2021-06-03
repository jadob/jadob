<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Bridge\Symfony;


use DateTimeImmutable;
use Jadob\Dashboard\Action\DashboardAction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardWrappedAction
{

    protected DashboardAction $action;

    public function __construct(DashboardAction $dashboardAction)
    {
        $this->action = $dashboardAction;
    }
    public function __invoke(Request $request, UserInterface $user)
    {
        $dashboardContext = new DashboardContext(
            DateTimeImmutable::createFromFormat(
                'U',
                (string)$request->server->get('REQUEST_TIME')
            ),
            $user
        );

        return $this->action->__invoke($request, $dashboardContext);
    }

}