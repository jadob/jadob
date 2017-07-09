<?php

namespace Slice\Core\HTTP;

/**
 * Class HTMLResponse
 * @package Slice\Core\HTTP
 */
class HTMLResponse implements ResponseInterface
{

    /**
     * @var string
     */
    private $content;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}