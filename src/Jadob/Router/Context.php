<?php

namespace Jadob\Router;

/**
 * @author  pizzaminded <miki@appvende.net>
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

        $context = new self();

        $context->setSecure(isset($_SERVER['HTTPS']));

        $host = $_SERVER['HTTP_HOST'] ?? null;

        if (strpos($host, ':') === false) {
            $context->setHost($host);
            $context->setPort($_SERVER['SERVER_PORT'] ?? null);

            return $context;
        }

        $explodedHost = \explode(':', $host);

        $context->setHost($explodedHost[0]);
        $context->setPort((int)$explodedHost[1]);

        return $context;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param  string $host
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
     * @param  bool $secure
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
     * @param  int $port
     * @return Context
     */
    public function setPort(?int $port): Context
    {
        $this->port = $port;
        return $this;
    }
}