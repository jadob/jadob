<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Twig;


use Jadob\Dashboard\ActionType;
use Jadob\Dashboard\CrudOperationType;
use Jadob\Dashboard\QueryStringParamName;
use Jadob\Dashboard\UrlGeneratorInterface;
use Jadob\Router\Router;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DashboardRoutingExtension extends AbstractExtension
{

    protected UrlGeneratorInterface $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public function getFunctions()
    {
        return [
           new TwigFunction('dashboard_path_object_list', [$this, 'getPathForObjectList']),
           new TwigFunction('dashboard_path_object_new', [$this, 'getPathForObjectNew']),
           new TwigFunction('dashboard_path_object_import', [$this, 'getPathForImport'])
        ];
    }


    public function getPathForObjectList(string $objectFqcn, int $page = 1): string
    {
        return $this->router->generateRoute(
            'jadob_dashboard_action',
            [
                QueryStringParamName::ACTION => ActionType::CRUD,
                QueryStringParamName::CRUD_OPERATION => CrudOperationType::LIST,
                QueryStringParamName::OBJECT_NAME => $objectFqcn,
                QueryStringParamName::CRUD_CURRENT_PAGE => $page
            ]
        );
    }

    public function getPathForObjectNew(string $objectFqcn): string
    {
        return $this->router->generateRoute(
            'jadob_dashboard_action',
            [
                QueryStringParamName::ACTION => ActionType::CRUD,
                QueryStringParamName::CRUD_OPERATION => CrudOperationType::NEW,
                QueryStringParamName::OBJECT_NAME => $objectFqcn
            ]
        );
    }

    public function getPathForImport(string $objectFqcn): string
    {
        return $this->router->generateRoute(
            'jadob_dashboard_action',
            [
                QueryStringParamName::ACTION => ActionType::IMPORT,
                QueryStringParamName::OBJECT_NAME => $objectFqcn
            ]
        );
    }
}