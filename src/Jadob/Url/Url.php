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

    protected ?string $url = null;

    protected ?string $scheme = null;

    protected ?int $port = null;

    protected ?string $host = null;

    protected ?string $path = null;

    /**
     * @var array
     */
    protected $query = [];

    /**
     * URL has changed since last build
     * @TODO to be dropped, or class to be refactored to be immutable
     */
    protected bool $changed = false;

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
     * @return string|null
     */
    public function getScheme(): ?string
    {
        return $this->scheme;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
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
     * @param array|string|int $value
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
