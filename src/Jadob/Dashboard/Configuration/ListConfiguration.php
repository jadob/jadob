<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;


class ListConfiguration
{
    protected array $fieldsToShow = [];
    protected array $operations = [];
    protected int $resultsPerPage = 25;

    /**
     * @return array
     */
    public function getFieldsToShow(): array
    {
        return $this->fieldsToShow;
    }

    /**
     * @param array $fieldsToShow
     */
    public function setFieldsToShow(array $fieldsToShow): void
    {
        $this->fieldsToShow = $fieldsToShow;
    }

    /**
     * @return array
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    /**
     * @return int
     */
    public function getResultsPerPage(): int
    {
        return $this->resultsPerPage;
    }

    /**
     * @param int $resultsPerPage
     */
    public function setResultsPerPage(int $resultsPerPage): void
    {
        $this->resultsPerPage = $resultsPerPage;
    }

    /**
     * @param array $operations
     */
    public function setOperations(array $operations): void
    {
        $this->operations = $operations;
    }


    public function getOperation(string $operationName)
    {
        return $this->operations[$operationName];
    }
}