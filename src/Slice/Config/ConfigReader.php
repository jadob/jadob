<?php

namespace Slice\Config;

use RuntimeException;

/**
 * Class responsible for find and parse configuration.
 * @package Slice\Config
 * @author pizzaminded <github.com/pizzaminded>
 */
class ConfigReader
{
    /**
     * @var string
     */
    protected $configDir;

    /**
     * @var string
     */
    private $environment;

    /**
     * @var array
     */
    protected $extensionsPriority;

    /**
     * @var array
     */
    protected $placeholders = [];

    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @var string
     */
    protected $mainConfigFileExtension;

    /**
     * ConfigReader constructor.
     */
    public function __construct()
    {
        $this->extensionsPriority = ['yml', 'php'];
        $this->configuration = new Configuration();
    }

    /**
     * @param string $dir
     * @return ConfigReader
     */
    public function setConfigDir($dir): ConfigReader
    {
        $this->configDir = $dir;
        return $this;
    }


    /**
     * @return array
     * @throws \RuntimeException
     */
    public function parseApplicationConfiguration(): array
    {
        $configFile = $this->findConfigFileByPriority();

        /**
         * @TODO: define way to parse php configuration files.
         */
        if ($this->getMainConfigFileExtension() === 'php') {

            return [];
        }

        $configurationParser = ParserFileFactory::getParser($this->getMainConfigFileExtension());

        $this->configuration
            ->join(
                $configurationParser->parse(
                    $this->getEnvironmentParamsPath(
                        $this->getEnvironment()
                    )
                )
            )
            ->join(['routes' => $configurationParser->parse($this->getRoutesPath())])
            ->join($configurationParser->parse($configFile));


        return $this->configuration->getFullConfiguration();
    }

    /**
     * At first, it will try to find config/config.yml. If found, method sets yml as default config file extension.
     * Otherwise it will find config/config.php [TBD].
     * Otherwise, method will throw an Exception.
     * @return string
     * @throws \RuntimeException
     */
    private function findConfigFileByPriority(): string
    {
        foreach ($this->extensionsPriority as $ext) {
            $configFilePath = $this->configDir . '/config.' . $ext;

            if (file_exists($configFilePath)) {
                $this->setMainConfigFileExtension($ext);
                return $configFilePath;
            }
        }

        throw new RuntimeException('Could not find any config file.');
    }

    /**
     * @return string
     */
    public function getMainConfigFileExtension(): string
    {
        return $this->mainConfigFileExtension;
    }

    /**
     * @param string $mainConfigFileExtension
     * @return ConfigReader
     */
    public function setMainConfigFileExtension(string $mainConfigFileExtension): ConfigReader
    {
        $this->mainConfigFileExtension = $mainConfigFileExtension;
        return $this;
    }


    /**
     * @param string $name
     * @param string $value
     * @return ConfigReader
     */
    public function addPlaceholder($name, $value): ConfigReader
    {
        $this->configuration->addPlaceholder($name, trim($value));

        return $this;
    }

    /**
     * @return array
     */
    public function getPlaceholders(): array
    {
        return $this->placeholders;
    }

    /**
     * @param string $environment
     * @return string
     */
    protected function getEnvironmentParamsPath($environment): string
    {
        return $this->configDir .
        '/env/' .
        $environment .
        '.' .
        $this->getMainConfigFileExtension();
    }

    /**
     * @return string
     */
    protected function getRoutesPath(): string
    {
        return $this->configDir .
        '/routes.' .
        $this->getMainConfigFileExtension();
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * @param mixed $environment
     * @return ConfigReader
     */
    public function setEnvironment($environment): ConfigReader
    {
        $this->environment = $environment;
        return $this;
    }
}