<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;


use Jadob\Dashboard\Exception\ConfigurationException;
use Jadob\Dashboard\Exception\DashboardException;

class ListConfiguration
{
    protected array $fieldsToShow = [];

    /**
     * @var array<string, EntityOperation>
     */
    protected array $operations = [];

    /**
     * @var array<string, EntityRedirectOperation>
     */
    protected array $redirects = [];

    protected int $resultsPerPage = 25;

    /**
     * @var array<string,PredefinedCriteria>
     */
    protected array $predefinedCriteria = [];

    protected function __construct(array $fieldsToShow)
    {
        $this->fieldsToShow = $fieldsToShow;
    }

    /**
     * @return array
     */
    public function getFieldsToShow(): array
    {
        return $this->fieldsToShow;
    }

    /**
     * @return array
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    /**
     * @return EntityRedirectOperation[]
     */
    public function getRedirects(): array
    {
        return $this->redirects;
    }


    /**
     * @return int
     */
    public function getResultsPerPage(): int
    {
        return $this->resultsPerPage;
    }

    public function getOperation(string $operationName): EntityOperation
    {
        return $this->operations[$operationName];
    }

    /**
     * @param string $for
     * @param array $config
     * @return ListConfiguration
     * @throws ConfigurationException
     */
    public static function create(string $for, array $config): ListConfiguration
    {
        if (!isset($config['fields'])) {
            throw new ConfigurationException(sprintf('Missing "fields" key for "%s" object!', $for));
        }

        if (!is_array($config['fields'])) {
            throw new ConfigurationException(sprintf('Value for "fields" key for "%s" object must be an array!', $for));
        }

        $self = new self($config['fields']);

        if (isset($config['results_per_page']) && !is_int($config['results_per_page'])) {
            throw new ConfigurationException(sprintf('Value for "results_per_page" key for "%s" object must be an int!', $for));
        }

        if (isset($config['results_per_page'])) {
            $self->resultsPerPage = $config['results_per_page'];
        }

        if (isset($config['operations']) && !is_array($config['operations'])) {
            throw new ConfigurationException(sprintf('Value for "operations" key for "%s" object must be an array!', $for));
        }

        if (isset($config['operations'])) {
            foreach ($config['operations'] as $operationName => $operationConfig) {
                if (!is_string($operationName)) {
                    throw new ConfigurationException(
                        sprintf(
                            'Key operations.%s for "%s" object is invalid and must be an string!',
                            $operationName,
                            $for
                        )
                    );
                }

                if (!is_array($operationConfig)) {
                    throw new ConfigurationException(
                        sprintf(
                            'Value for operations.%s key for "%s" object must be an array!',
                            $operationName,
                            $for
                        )
                    );
                }


                $self->operations[$operationName] = EntityOperation::fromArray($operationName, $operationConfig);
            }
        }

        if(isset($config['redirects']) && is_array($config['redirects'])) {
            foreach ($config['redirects'] as $name => $redirectConfig) {
                $self->redirects[$name] = new EntityRedirectOperation(
                    $name,
                    $redirectConfig['label'],
                    $redirectConfig['path'],
                    $redirectConfig['transform']
                );
            }
        }

        if(isset($config['predefined_criteria']) && is_array($config['predefined_criteria'])) {
            foreach ($config['predefined_criteria'] as $name => $predefinedCriteriaConfig) {
                $self->predefinedCriteria[$name] = PredefinedCriteria::create($name, $predefinedCriteriaConfig);
            }
        }

        return $self;
    }

    /**
     * @return array<string, PredefinedCriteria>
     */
    public function getPredefinedCriteria(): array
    {
        return $this->predefinedCriteria;
    }


}