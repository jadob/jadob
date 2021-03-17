<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;

use Jadob\Dashboard\Exception\ConfigurationException;
use Jadob\Dashboard\Exception\DashboardException;

class ManagedObject
{
    protected ListConfiguration $listConfiguration;
    protected string $objectFqcn;
    protected ?NewObjectConfiguration $newObjectConfiguration = null;

    protected function __construct(string $objectFqcn, ListConfiguration $listConfiguration)
    {
        $this->objectFqcn = $objectFqcn;
        $this->listConfiguration = $listConfiguration;
    }

    public static function create(string $objectFqcn): self
    {
        return new self($objectFqcn, new ListConfiguration());
    }

    /**
     * @return ListConfiguration
     */
    public function getListConfiguration(): ListConfiguration
    {
        return $this->listConfiguration;
    }

    /**
     * @param string $objectFqcn
     * @param array $configuration
     * @return static
     * @throws ConfigurationException
     * @throws DashboardException
     */
    public static function fromArray(string $objectFqcn, array $configuration): self
    {
        $self = self::create($objectFqcn);

        if(!isset($configuration['list'])) {
            throw new ConfigurationException('Missing "list" key for "%s" object.', $objectFqcn);
        }

        $self->listConfiguration->setFieldsToShow($configuration['list']['fields'] ?? []);
        $self->listConfiguration->setResultsPerPage($configuration['list']['results_per_page'] ?? 25);
        $self->listConfiguration->setOperations($self->entityOperationsFromArray($configuration['list']['operations'] ?? []));

        if(isset($configuration['new'])) {
            $self->newObjectConfiguration = NewObjectConfiguration::fromArray($configuration['new']);
        }

        return $self;
    }

    public function hasNewObjectConfiguration(): bool
    {
        return $this->newObjectConfiguration !== null;
    }

    /**
     * @return NewObjectConfiguration|null
     */
    public function getNewObjectConfiguration(): ?NewObjectConfiguration
    {
        return $this->newObjectConfiguration;
    }


    /**
     * @param array $operations
     * @return array
     * @throws DashboardException
     */
    protected function entityOperationsFromArray(array $operations): array
    {
        $output = [];
        foreach ($operations as $operationName => $operationConfig) {
            $output[$operationName] = new EntityOperation(
                $operationName,
                $operationConfig['label'],
                $operationConfig['handler_fqcn'] ?? null,
                $operationConfig['handler_method'] ?? null,
                $operationConfig['transform'] ?? null,
                $operationConfig['force_persist'] ?? false
            );
        }

        return $output;
    }

}