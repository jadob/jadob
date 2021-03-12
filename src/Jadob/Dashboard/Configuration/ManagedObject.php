<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;

class ManagedObject
{
    protected ListConfiguration $listConfiguration;
    protected string $objectFqcn;

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

    public static function fromArray(string $objectFqcn, array $configuration): self
    {
        $self = self::create($objectFqcn);
        $self->listConfiguration->setFieldsToShow($configuration['list']['fields'] ?? []);
        $self->listConfiguration->setResultsPerPage($configuration['list']['results_per_page'] ?? 25);
        return $self;
    }

}