<?php
namespace Slice\Config;

use RuntimeException;
use Slice\Core\AppVariables;
use Slice\Core\Environment;

/**
 * Class ConfigReader
 * @package Slice\Config
 */
class ConfigReader
{
    /**
     * @var string
     */
    protected $configDir;

    /**
     * @var AppVariables
     */
    protected $app;

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

    public function __construct(AppVariables $app)
    {
        $this->extensionsPriority = ['yml', 'ini', 'php'];
        $this->app = $app;
        $this->configuration = new Configuration();

    }

    public function setConfigDir($dir): ConfigReader
    {
        $this->configDir = $dir;
        return $this;
    }

    public function loadConfiguration(): array
    {
        return [];
    }

    public function parseApplicationConfiguration(): array
    {
        $configFile = $this->findConfigFileByPriority();

        if ($this->getMainConfigFileExtension() === 'php') {

            return [];
        }

        $configurationParser = ParserFileFactory::getParser($this->getMainConfigFileExtension());

        $this->configuration
            ->join(
                $configurationParser->parse(
                    $this->getEnvironmentParamsPath(
                        $this->app->getEnvironment()
                    )
                )
            )
            ->join(['routes' => $configurationParser->parse($this->getRoutesPath())])
            ->join($configurationParser->parse($configFile));


        return $this->configuration->getFullConfiguration();
    }

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


    public function addPlaceholder($name, $value)
    {
        $this->configuration->addPlaceholder($name, trim($value));

        return $this;
    }

    public function getPlaceholders(): array
    {
        return $this->placeholders;
    }

    protected function getEnvironmentParamsPath(Environment $environment): string
    {
        return $this->configDir .
        '/env/' .
        $environment->getEnvironment() .
        '.' .
        $this->getMainConfigFileExtension();
    }

    protected function getRoutesPath(): string
    {
        return $this->configDir .
        '/routes.' .
        $this->getMainConfigFileExtension();
    }

}