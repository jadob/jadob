<?php

namespace Jadob\Security\Firewall;

/**
 * Class ExcludedPath
 * @package Jadob\Security\Firewall
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ExcludedPath
{

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string|null
     */
    protected $host;

    public function __construct($path, $host = null)
    {
        $this->path = $path;
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return ExcludedPath
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string|null $host
     * @return ExcludedPath
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

}