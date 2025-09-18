<?php
declare(strict_types=1);

namespace Jadob\Router;

use Jadob\Router\Exception\RouterException;
use function explode;
use function strlen;
use function substr;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
final readonly class RouterContext
{

    public function __construct(
        private string $host,
        private bool $secure,
        private int $port,
        private(set) ?string $basePath = null,
    )
    {
    }


    /**
     * @param string $baseUrl
     * @return self
     * @throws RouterException
     * @deprecated - all tests for this method (either failing or not) have been removed
     * Please revert them (and fix!) or add new in case of keeping this method still in the codebase.
     */
    public static function fromBaseUrl(string $baseUrl): RouterContext
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
     * @return RouterContext
     */
    public static function fromGlobals()
    {
        $context = new self();

        $context->setSecure(isset($_SERVER['HTTPS']));

        /** @var string|null $host */
        $host = $_SERVER['HTTP_HOST'] ?? null;

        if (!str_contains((string) $host, ':')  ) {
            $context->setHost($host);

            $port = null;
            // @TODO: is that is_string check required?
            if (isset($_SERVER['SERVER_PORT']) && is_string($_SERVER['SERVER_PORT'])) {
                $port = (int) $_SERVER['SERVER_PORT'];
            }

            $context->setPort($port);

            return $context;
        }

        $explodedHost = explode(':', (string) $host);

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
     * @return RouterContext
     */
    public function setHost(?string $host): RouterContext
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
     * @return RouterContext
     */
    public function setSecure(bool $secure): RouterContext
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
     * @return RouterContext
     */
    public function setPort(?int $port): RouterContext
    {
        $this->port = $port;
        return $this;
    }

}