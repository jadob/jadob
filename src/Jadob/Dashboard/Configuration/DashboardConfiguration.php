<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;


class DashboardConfiguration
{
    protected array $dashboards = [];

    protected array $managedObjects = [];

    protected string $defaultDashboardName;

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

        if(isset($config['managed_objects']) && is_array($config['managed_objects'])) {
            foreach ($config['managed_objects'] as $managedObjectKey => $managedObject) {
                /**
                 * Additional configuration is passed to managed object:
                 * User:class => []
                 */
                if(is_string($managedObjectKey) && is_array($managedObject)) {
                    $self->managedObjects[$managedObjectKey] = $managedObject;
                }

                /**
                 * There is no additional config, object fqcn is just passed to managed_objects:
                 * [
                 *      User:class
                 * ]
                 */
                if(is_int($managedObjectKey) && is_string($managedObject)) {
                    $self->managedObjects[$managedObject] = [];
                }

                //@TODO: exception, unexpected thing passed to managed_objects
            }
        }

        if(!isset($config['default_dashboard'])) {
            throw new \RuntimeException('There is no default dashboard defined!');
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

    public function getManagedObjectConfiguration(string $objectFqcn): array
    {
        return $this->managedObjects[$objectFqcn];
    }
}