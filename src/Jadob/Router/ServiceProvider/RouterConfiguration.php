<?php

namespace Jadob\Router\ServiceProvider;

class RouterConfiguration
{
    private array $routes = [];
    private bool $caseSensitive = false;
    private ?string $host = null;
    private ?string $basePath = null;
    private(set) ?bool $secure = null;
    private ?int $port = null;

    public function setCaseSensitive(bool $caseSensitive): void
    {
        $this->caseSensitive = $caseSensitive;
    }


    public function importRoutes(array $routes): void
    {
        $this->routes = array_merge($this->routes, $routes);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function isCaseSensitive(): bool
    {
        return $this->caseSensitive;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(?string $host): void
    {
        $this->host = $host;
    }

    public function getBasePath(): ?string
    {
        return $this->basePath;
    }

    public function setBasePath(?string $basePath): void
    {
        $this->basePath = $basePath;
    }


    public function setSecure(?bool $secure): void
    {
        $this->secure = $secure;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function setPort(?int $port): void
    {
        $this->port = $port;
    }

    public function configureFromBaseUrl(string $baseUrl): void
    {
        $parsedUrl = parse_url($baseUrl);

        $this->host = $parsedUrl['host'];
        $this->basePath = $parsedUrl['path'] ?? null;
        $this->secure = $parsedUrl['scheme'] === 'https';
        $this->port = $parsedUrl['port'] ?? null;

    }
}