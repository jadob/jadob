<?php

namespace Jadob\Router;

/**
 * Class Context
 * @package Jadob\Router
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Context
{

    /**
     * @var string
     */
    protected $host;

    /**
     * @var bool
     */
    protected $secure = false;

    /**
     * @var int|null
     */
    protected $port;

    /**
     * @return Context
     */
    public static function fromGlobals()
    {
        return (new self())
            ->setHost($_SERVER['HTTP_HOST'] ?? null)
            ->setPort($_SERVER['SERVER_PORT'] ?? null)
            ->setSecure(isset($_SERVER['HTTPS']));
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     * @return Context
     */
    public function setHost(?string $host): Context
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSecure(): bool
    {
        return $this->secure;
    }

    /**
     * @param bool $secure
     * @return Context
     */
    public function setSecure(bool $secure): Context
    {
        $this->secure = $secure;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @return Context
     */
    public function setPort(?int $port): Context
    {
        $this->port = $port;
        return $this;
    }
}