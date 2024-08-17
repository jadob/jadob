<?php
declare(strict_types=1);

namespace Jadob\Dashboard\ObjectOperation;

use Jadob\Contracts\Dashboard\DashboardContextInterface;
use Jadob\Contracts\Dashboard\ObjectOperation\SingleObjectOperationInterface;
use Jadob\Objectable\ItemProcessor;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ShowOperation implements SingleObjectOperationInterface
{
    public function __construct(
        protected Environment $twig,
        protected ItemProcessor $itemProcessor
    ) {
    }

    public function handle(DashboardContextInterface $context, object $object, ?string $objectId): Response
    {
        return new Response(
            $this->twig->render(
                '@JadobDashboard/crud/show.html.twig', [
                    'list' => $this->itemProcessor->extractItemValues($object, ['DASHBOARD_SHOW']),
                    'object_fqcn' => get_class($object)
                ]
            )
        );
    }

    public function allowsNullObjectId(): bool
    {
        return false;
    }
}