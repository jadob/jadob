<?php
declare(strict_types=1);

namespace Jadob\Router;

use function explode;
use Jadob\Router\Exception\RouterException;
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
     * @param string $baseUrl
     * @return self
     * @throws RouterException
     */
    public static function fromBaseUrl(string $baseUrl): Context
    {
        $url = parse_url($baseUrl);

        if (!is_array($url)) {
            throw new RouterException('Unable to create context from base url: Invalid URL passed');
        }

        if (!isset($url['host'])) {
            throw new RouterException('Unable to create context from base url: Missing hostname');
        }

        $host = $url['host'];
        if (isset($url['port'])) {
            $port = $url['port'];
        } elseif ($url['scheme'] === 'http') {
            $port = 80;
        } else {
            $port = 443;
        }

        $self = new self();
        $self->setHost($host)
            ->setPort($port);

        if (isset($url['scheme']) && $url['scheme'] === 'https') {
            $self->setSecure(true);
        }

        if (isset($url['path'])) {
            $self->setAlias($url['path']);
        }

        return $self;
    }

    /**
     * @return Context
     */
    public static function fromGlobals()
    {
        $context = new self();

        $context->setSecure(isset($_SERVER['HTTPS']));

        /** @var string|null $host */
        $host = $_SERVER['HTTP_HOST'] ?? null;

        if (!str_contains((string)$host, ':')  ) {
            $context->setHost($host);

            $port = null;
            if(isset($_SERVER['SERVER_PORT']) && is_string($_SERVER['SERVER_PORT'])) {
                $port = (int)$_SERVER['SERVER_PORT'];
            }

            $context->setPort($port);

            return $context;
        }

        $explodedHost = explode(':', (string)$host);

        $context->setHost($explodedHost[0]);
        $context->setPort((int) $explodedHost[1]);

        //check for alias
        //@TODO: check for CONTEXT_DOCUMENT_ROOT for Apache
        //@TODO: check how does aliases are resolved in nginx

        /** @var string $requestUri */
        $requestUri = $_SERVER['REQUEST_URI'];

        //trim query string
        if (($questionMarkPosition = strpos($requestUri, '?')) !== false) {
            $requestUri = substr($requestUri, 0, $questionMarkPosition);
        }

        /**
         * some SAPIs like cli-server does not register PATH_INFO when we are on / request
         * @psalm-var string $pathInfo
         */
        $pathInfo = $_SERVER['PATH_INFO'] ?? '/';

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