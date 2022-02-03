<?php
declare(strict_types=1);

namespace Jadob\Dashboard;

use Jadob\Dashboard\Configuration\EntityRedirectOperation;
use Jadob\Dashboard\Configuration\PredefinedCriteria;

class PathGenerator
{
    protected UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function getPathForObjectList(string $objectFqcn, int $page = 1, ?PredefinedCriteria $criteria = null): string
    {
        $params = [
            QueryStringParamName::ACTION => ActionType::CRUD,
            QueryStringParamName::CRUD_OPERATION => CrudOperationType::LIST,
            QueryStringParamName::OBJECT_NAME => $objectFqcn,
            QueryStringParamName::CRUD_CURRENT_PAGE => $page,
        ];

        if ($criteria !== null) {
            $params[QueryStringParamName::LIST_CRITERIA] = $criteria->getName();
        }

        return $this->urlGenerator->generateRoute(
            'jadob_dashboard_action',
            $params
        );
    }

    public function getPathForObjectNew(string $objectFqcn): string
    {
        return $this->urlGenerator->generateRoute(
            'jadob_dashboard_action',
            [
                QueryStringParamName::ACTION => ActionType::CRUD,
                QueryStringParamName::CRUD_OPERATION => CrudOperationType::NEW,
                QueryStringParamName::OBJECT_NAME => $objectFqcn
            ]
        );
    }

    public function getPathForObjectEdit(string $objectFqcn, $objectId): string
    {
        return $this->urlGenerator->generateRoute(
            'jadob_dashboard_action',
            [
                QueryStringParamName::ACTION => ActionType::CRUD,
                QueryStringParamName::CRUD_OPERATION => CrudOperationType::EDIT,
                QueryStringParamName::OBJECT_ID => $objectId,
                QueryStringParamName::OBJECT_NAME => $objectFqcn
            ]
        );
    }

    public function getPathForImport(string $objectFqcn): string
    {
        return $this->urlGenerator->generateRoute(
            'jadob_dashboard_action',
            [
                QueryStringParamName::ACTION => ActionType::IMPORT,
                QueryStringParamName::OBJECT_NAME => $objectFqcn
            ]
        );
    }

    public function getPathForObjectOperation(string $objectFqcn, $objectId, string $operationName): string
    {
        return $this->urlGenerator->generateRoute(
            'jadob_dashboard_action',
            [
                QueryStringParamName::ACTION => ActionType::OPERATION,
                QueryStringParamName::OBJECT_NAME => $objectFqcn,
                QueryStringParamName::OBJECT_ID => $objectId,
                QueryStringParamName::OPERATION_NAME => $operationName
            ]
        );
    }

    public function getPathForObjectRedirect(EntityRedirectOperation $operation, object $object): string
    {
        return $this->urlGenerator->generateRoute(
            $operation->getPath(),
            $operation->getArgumentTransformer()($object)
        );
    }

    public function getPathForBatchOperation(string $objectFqcn): string
    {
        return $this->urlGenerator->generateRoute(
            'jadob_dashboard_action',
            [
                QueryStringParamName::ACTION => ActionType::BATCH_OPERATION,
                QueryStringParamName::OBJECT_NAME => $objectFqcn,
            ]
        );
    }
}