<?php

namespace Jadob\Router;

use function explode;
use function strlen;
use function substr;

/**
 * TODO rename to RouterContext
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
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
     * There are at least two examples when alias will be filled:
     *
     * 1. App is hidden via Alias directive in webserver configuration
     * 2. Document root has been run a level below our public directory
     *
     * @see https://httpd.apache.org/docs/2.4/mod/mod_alias.html#alias
     * @see http://nginx.org/en/docs/http/ngx_http_core_module.html#alias
     * @var string|null
     */
    protected ?string $alias = null;

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

        $explodedHost = explode(':', $host);

        $context->setHost($explodedHost[0]);
        $context->setPort((int)$explodedHost[1]);

        //check for alias
        //@TODO: check for CONTEXT_DOCUMENT_ROOT for Apache
        //@TODO: check how does aliases are resolved in nginx

        //URI requested by client
        $requestUri = $_SERVER['REQUEST_URI'];

        //trim query string
        if(($questionMarkPosition = strpos($requestUri, '?')) !== false) {
            $requestUri = substr($requestUri, 0, $questionMarkPosition);
        }

        //URI resolved by webserver
        $pathInfo = $_SERVER['PATH_INFO'];

        //if these two does not match that means that request has been "aliased"
        if ($requestUri !== $pathInfo) {
            $context->setAlias(substr($requestUri, 0, -strlen($pathInfo)));
        }

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

    /**
     * @return string|null
     */
    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @param string|null $alias
     * @return Context
     */
    public function setAlias(?string $alias): Context
    {
        $this->alias = $alias;
        return $this;
    }


}