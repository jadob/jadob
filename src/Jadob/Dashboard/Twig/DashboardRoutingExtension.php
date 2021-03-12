<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Twig;

use Jadob\Dashboard\PathGenerator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DashboardRoutingExtension extends AbstractExtension
{
    protected PathGenerator $pathGenerator;

    public function __construct(PathGenerator $pathGenerator)
    {
        $this->pathGenerator = $pathGenerator;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('dashboard_path_object_list', [$this->pathGenerator, 'getPathForObjectList']),
            new TwigFunction('dashboard_path_object_new', [$this->pathGenerator, 'getPathForObjectNew']),
            new TwigFunction('dashboard_path_object_import', [$this->pathGenerator, 'getPathForImport'])
        ];
    }
}