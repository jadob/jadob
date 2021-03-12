<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;

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

    public static function fromArray(string $objectFqcn, array $configuration): self
    {
        $self = self::create($objectFqcn);
        $self->listConfiguration->setFieldsToShow($configuration['list']['fields'] ?? []);
        $self->listConfiguration->setResultsPerPage($configuration['list']['results_per_page'] ?? 25);

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

}