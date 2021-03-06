<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Twig;


use Jadob\Dashboard\Component\ComponentProcessor;
use Symfony\Component\HttpFoundation\Request;
use Twig\Extension\AbstractExtension;
use Twig\Extension\ExtensionInterface;
use Twig\TwigFunction;

class DashboardExtension extends AbstractExtension
{

    protected ComponentProcessor $componentProcessor;

    public function __construct(ComponentProcessor $componentProcessor)
    {
        $this->componentProcessor = $componentProcessor;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('dashboard_get_component_data', [$this, 'getComponentData']),
            new TwigFunction('dashboard_get_template', [$this, 'getTemplate'])
        ];
    }

    public function getComponentData(
        string $providerFqcn,
        Request $request,
        \DateTimeInterface $requestDateTime,
        array $context
    ): array
    {
        return $this->componentProcessor->getComponentData($providerFqcn, $request, $requestDateTime, $context);
    }

    public function getTemplate(string $providerFqcn)
    {
        return $this->componentProcessor->getComponentTemplate($providerFqcn);
    }
}