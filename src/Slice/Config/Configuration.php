<?php
namespace Slice\Config;

use RuntimeException;

class Configuration
{

    /**
     * mergePlaceholder will throw an exception if it will loop for over this count to prevent unlimited looping.
     */
    const LOOP_LIMIT = 150;


    public $placeholders = [];

    protected $configuration = [];

    protected $mappedPlaceholders = [];

    public function getFullConfiguration(): array
    {
        $this->mergePlaceholders();

        return $this->parseConfiguration($this->configuration);
    }

    public function join(array $array)
    {
        $this->configuration = array_merge($this->configuration, $array);
        $this->generatePlaceholders($array);

        return $this;
    }

    public function addPlaceholder($name, $value)
    {
        $this->placeholders[$name] = trim($value);

        return $this;
    }

    protected function multiImplode(array $array, $prefix = ''): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                /** @noinspection SlowArrayOperationsInLoopInspection */
                $result = array_merge($result, $this->multiImplode($value, $prefix . $key . '.'));
            } else {
                $placeholderName = $prefix . $key;
                $result[$placeholderName] = $value;
            }
        }
        return $result;
    }

    public function generatePlaceholders(array $array)
    {
        $this->setReplacePlaceholders($this->multiImplode($array));

    }

    public function setReplacePlaceholders(array $value): Configuration
    {

        $this->placeholders = array_merge($this->placeholders, $value);
        return $this;
    }

    protected function mergePlaceholders(): array
    {
        foreach ($this->placeholders as $key => $value) {
            $this->mappedPlaceholders['%{' . $key . '}'] = $value;
        }

        $needToRoundAgain = true;
        $round = 0;
        while ($needToRoundAgain) {
            $round++;
            $totalCount = 0;
            foreach ($this->mappedPlaceholders as $key => $value) {
                $counts = 0;
                $value = str_replace(
                    array_keys($this->mappedPlaceholders),
                    array_values($this->mappedPlaceholders),
                    $value,
                    $counts);
                $this->mappedPlaceholders[$key] = $value;
                $totalCount += $counts;
            }
            if ($totalCount === 0) {
                $needToRoundAgain = false;
            }

            if ($round >= self::LOOP_LIMIT) {
                throw new RuntimeException('Unable to parse configuration.');
            }

        }

        return $this->mappedPlaceholders;

    }

    protected function parseConfiguration(array $array): array
    {
        $output = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $output[$key] = $this->parseConfiguration($value);
            } else {
                $output[$key] = str_replace(
                    array_keys($this->mappedPlaceholders),
                    array_values($this->mappedPlaceholders),
                    $value);
            }
        }

        return $output;
    }

    protected function overrideValues($array, $data)
    {

    }


}