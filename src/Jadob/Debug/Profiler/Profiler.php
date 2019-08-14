<?php

namespace Jadob\Debug\Profiler;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Profiler
{

    /**
     * @var string
     */
    protected $storageDir;

    /**
     * @var string
     */
    protected $requestId;

    /**
     * @var array
     */
    protected $xDebugCoverage = [];

    /**
     * @var array
     */
    protected $entries = [];

    /**
     * Profiler constructor.
     * @param string $storageDir
     */
    public function __construct(
        string $storageDir,
        string $requestId
    )
    {
        $this->storageDir = $storageDir;
        $this->requestId = $requestId;
    }

    public function addEntry(string $entryName, $value)
    {
        $this->entries[$entryName] = $value;
        return $this;
    }

    public function collectXDebugCoverage()
    {
        $this->xDebugCoverage = xdebug_get_code_coverage();
        return $this;
    }

    public function flush(): void
    {

        $content = [];
        $content['entries'] = $this->entries;
        $content['code_coverage'] = $this->xDebugCoverage;

        $file = $this->storageDir . '/' . $this->requestId . '.json';

        $this->createStorageDir();
        file_put_contents($file, json_encode($content));
    }

    protected function createStorageDir(): void
    {
        if (!is_dir($this->storageDir)) {
            mkdir($this->storageDir);
        }
    }

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

}