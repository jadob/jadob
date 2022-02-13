<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;

use Jadob\Dashboard\Exception\ConfigurationException;
use Jadob\Dashboard\Exception\DashboardException;

class ManagedObject
{
    protected ListConfiguration $listConfiguration;
    protected string $objectFqcn;
    protected ?string $objectManager = null;
    protected ?NewObjectConfiguration $newObjectConfiguration = null;
    protected ?EditConfiguration $editConfiguration = null;

    protected function __construct(string $objectFqcn, ListConfiguration $listConfiguration)
    {
        $this->objectFqcn = $objectFqcn;
        $this->listConfiguration = $listConfiguration;
    }

    public static function create(string $objectFqcn, ListConfiguration $configuration): self
    {
        return new self($objectFqcn, $configuration);
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
        if (!isset($configuration['list'])) {
            throw new ConfigurationException(sprintf('Missing "list" key for "%s" object.', $objectFqcn));
        }

        if (!is_array($configuration['list'])) {
            throw new ConfigurationException(sprintf('Key "list" for "%s" object is not an array', $objectFqcn));
        }

        $listConfiguration = ListConfiguration::create($objectFqcn, $configuration['list']);
        $self = self::create($objectFqcn, $listConfiguration);

        if (isset($configuration['new'])) {
            $self->newObjectConfiguration = NewObjectConfiguration::fromArray($configuration['new']);
        }

        if (isset($configuration['edit'])) {
            $self->editConfiguration = EditConfiguration::fromArray($configuration['edit']);
        }

        if(isset($configuration['object_manager'])) {
            $self->objectManager = $configuration['object_manager'];
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
     * @return EditConfiguration|null
     */
    public function getEditConfiguration(): ?EditConfiguration
    {
        return $this->editConfiguration;
    }

    /**
     * @param EditConfiguration|null $editConfiguration
     * @return ManagedObject
     */
    public function setEditConfiguration(?EditConfiguration $editConfiguration): ManagedObject
    {
        $this->editConfiguration = $editConfiguration;
        return $this;
    }

    public function hasEditConfiguration(): bool
    {
        return $this->editConfiguration !== null;
    }

    /**
     * @return string|null
     */
    public function getObjectManager(): ?string
    {
        return $this->objectManager;
    }
}