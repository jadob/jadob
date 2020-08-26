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
     * @var int
     */
    protected $port;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $query = [];

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

        if (isset($output['port'])) {
            $this->port = $output['port'];
        }

        if (isset($output['scheme'])) {
            $this->scheme = $output['scheme'];
        }

        if (isset($output['path'])) {
            $this->path = $output['path'];
        }

        if (isset($output['query'])) {
            parse_url(
                $output['query'],
                $this->query
            );
        }
    }

    /**
     * @return string
     */
    public function build(): string
    {
        $query = http_build_query($this->query);
        $port = $this->port !== null ? ':' . $this->port : null;
        return $this->scheme . '://' . $this->host . $port . $this->path . '?' . $query;
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
     * @param string $scheme
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
     * @param string $path
     * @return Url
     */
    public function setPath(string $path): Url
    {
        $this->changed = true;
        $this->path = $path;
        return $this;
    }

    /**
     * @param string $key
     * @param string|int|array $value
     * @return $this
     */
    public function addQueryParameter(string $key, $value): self
    {
        if (!is_scalar($value) && !is_array($value)) {
            throw new \InvalidArgumentException('Given $value parameter should be scalar or array');
        }

        $this->changed = true;
        $this->query[$key] = $value;

        return $this;
    }


}
