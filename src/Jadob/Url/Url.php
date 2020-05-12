<?php

declare(strict_types=1);

namespace Jadob\Url;

/**
 * TODO maybe comply with UriInterface?
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Url
{
    /**
     * @var string|null
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
     * @var string
     */
    protected $query;

    /**
     * @var bool
     */
    protected $changed = false;

    /**
     * Url constructor.
     *
     * @param string|null $url
     */
    public function __construct(?string $url = null)
    {
        $this->url = $url;

        if ($url !== null) {
            $this->parse($url);
        }
    }

    protected function parse(string $url): void
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

        if (isset($output['query'])) {
            $this->query = $output['query'];
        }
    }

    /**
     * @return string
     */
    public function build(): string
    {
        return $this->scheme.'://'.$this->host.$this->path.'?'.$this->query;
    }

    /**
     * Shorthand for build()
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->url !== null && !$this->changed) {
            return (string)$this->url;
        }

        return $this->build();
    }


    public function setHost(string $host): void
    {
        $this->changed = true;
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
     * @param  string $scheme
     * @return Url
     */
    public function setScheme(string $scheme): Url
    {
        $this->changed = true;
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
     * @param  string $path
     * @return Url
     */
    public function setPath(string $path): Url
    {
        $this->changed = true;
        $this->path = $path;
        return $this;
    }

}
