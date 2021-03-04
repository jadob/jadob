<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Component;


use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class ComponentProcessor
{
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getComponentData(
        string $providerFqcn,
        Request $request,
        \DateTimeInterface $requestDateTime,
        array $context
    ): array {


        $this->assertProviderUsability($providerFqcn);

        /** @var ComponentProviderInterface $provider */
        $provider = $this->container->get($providerFqcn);
        return $provider->getData($request, $requestDateTime, $context);

    }

    public function getComponentTemplate(string $providerFqcn): string
    {
        $this->assertProviderUsability($providerFqcn);

        /** @var ComponentProviderInterface $provider */
        $provider = $this->container->get($providerFqcn);
        return $provider->getTemplatePath();
    }

    /**
     * @param string $providerFqcn
     * @throws \RuntimeException
     */
    protected function assertProviderUsability(string $providerFqcn): void
    {
        if(!in_array(ComponentProviderInterface::class, class_implements($providerFqcn), true)) {
            throw new \RuntimeException(
                sprintf(
                    'Class "%s" should implement "%s" if it should be used to provide data to dashboard components.',
                    $providerFqcn,
                    ComponentProviderInterface::class
                )
            );
        }
    }
}