<?php

namespace Jadob\Url;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Url
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $scheme;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $path;

    /**
     * Url constructor.
     * @param string|null $url
     */
    public function __construct(?string $url = null)
    {
        if ($url !== null) {
            $this->url = $url;
            $this->parse($url);
        }
    }

    protected function parse(string $url)
    {
        $output = parse_url($url);

        if (isset($output['host'])) {
            $this->host = $output['host'];
        }

        if (isset($output['scheme'])) {
            $this->scheme = $output['scheme'];
        }

        if (isset($output['path'])) {
            $this->path = $output['path'];
        }
    }

    /**
     * @return string
     */
    public function build(): string
    {
        throw new \Exception('not implemented yet');
    }

    /**
     * Shorthand for build()
     * @return string
     */
    public function __toString()
    {
        if ($this->url !== null) {
            return (string)$this->url;
        }

        return $this->build();
    }


    public function setHost(string $host)
    {
        $this->host = $host;
    }

    public function getHost(): ?string
    {
        return $this->host;

    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     * @return Url
     */
    public function setScheme(string $scheme): Url
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Url
     */
    public function setPath(string $path): Url
    {
        $this->path = $path;
        return $this;
    }

}
