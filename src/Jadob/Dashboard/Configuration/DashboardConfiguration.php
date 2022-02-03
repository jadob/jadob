<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;

use Jadob\Dashboard\Exception\ConfigurationException;
use RuntimeException;

class DashboardConfiguration
{
    protected array $dashboards = [];

    /**
     * @var array<string, ManagedObject>
     */
    protected array $managedObjects = [];

    protected array $actions = [];

    protected string $defaultDashboardName;

    /**
     * @param array $config
     * @return static
     * @throws ConfigurationException
     */
    public static function fromArray(array $config): self
    {
        $self = new self();
        foreach ($config['dashboards'] as $name => $dashboardDef) {
            $dashboardObj = new Dashboard(
                $name,
                Grid::fromArray($dashboardDef['grid'] ?? []),
                $dashboardDef['title']
            );

            $self->dashboards[$name] = $dashboardObj;
        }

        if (isset($config['actions']) && is_array($config['actions'])) {
            foreach ($config['actions'] as $actionName => $actionConfig) {
                $self->actions[$actionName] = ActionConfiguration::fromArray($actionConfig);
            }
        }

        if (isset($config['managed_objects']) && is_array($config['managed_objects'])) {
            foreach ($config['managed_objects'] as $managedObjectFqcn => $managedObjectConfig) {
                if (is_string($managedObjectFqcn) && is_array($managedObjectConfig)) {
                    $self->managedObjects[$managedObjectFqcn] = ManagedObject::fromArray($managedObjectFqcn, $managedObjectConfig);
                    continue;
                }

                throw new ConfigurationException(
                    sprintf(
                        'Could not process configuration for "%s" as it does not have nor valid key nor valid value.',
                        $managedObjectConfig
                    )
                );
            }
        }

        if (!isset($config['default_dashboard'])) {
            throw new RuntimeException('There is no default dashboard defined!');
        }

        $self->defaultDashboardName = $config['default_dashboard'];
        return $self;
    }

    public function getDefaultDashboard(): Dashboard
    {
        return $this->dashboards[$this->defaultDashboardName];
    }

    /**
     * @return string[]
     */
    public function getManagedObjects(): array
    {
        return array_keys($this->managedObjects);
    }

    public function getManagedObjectConfiguration(string $objectFqcn): ManagedObject
    {
        return $this->managedObjects[$objectFqcn];
    }

    /**
     * @return array
     */
    public function getActions(): array
    {
        return $this->actions;
    }
}