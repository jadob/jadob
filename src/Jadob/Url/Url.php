<?php

declare(strict_types=1);

namespace Jadob\Url;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
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
     * @var null|string
     */
    protected $path;

    /**
     * @var array
     */
    protected $query = [];

    /**
     * @var null|string
     */
    protected $fragment;

    protected ?int $port = null;

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

    protected function parse(string $url): void
    {
        $output = \parse_url($url);

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

        $this->fragment = $output['fragment'] ?? null;

        if (isset($output['query'])) {
            parse_url(
                $output['query'],
                $this->query
            );
        }
    }

    /**
     * @return bool
     */
    public function hasScheme(): bool
    {
        return $this->scheme !== null;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function build(): string
    {
        $isHttpUrl = in_array(mb_strtolower($this->getScheme()), ['http', 'https'], true);
        if ($this->scheme === null) {
            throw new \RuntimeException('Missing scheme in URL Object');
        }

        if ($this->host === null && $isHttpUrl) {
            throw new \RuntimeException('Missing host in URL Object');
        }


        $url = $this->scheme . '://' . $this->host;
        if (!$isHttpUrl) {
            $url = $this->scheme . ':' . $this->host;
        }

        if ($this->path !== null) {
            if ($isHttpUrl) {
                $url .= '/' . ltrim($this->path, '/');
            } else {
                $url .= $this->path;
            }
        }

        if ($this->fragment !== null) {
            $url .= '#' . $this->fragment;
        }

        return $url;
    }

    /**
     * Shorthand for build()
     * @return string
     * @throws \Exception
     */
    public function __toString()
    {
        if ($this->url !== null) {
            return (string)$this->url;
        }

        return $this->build();
    }


    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
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
     * @return null|string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return string|null
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * @param string|null $fragment
     * @return Url
     */
    public function setFragment(?string $fragment): Url
    {
        $this->fragment = $fragment;
        return $this;
    }

    public function removeFragment(): Url
    {
        $this->fragment = null;
        return $this;
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

        $this->query[$key] = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

}
