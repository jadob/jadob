<?php

namespace Slice\Core\HTTP;

/**
 * Interface ResponseInterface
 * @package Slice\Core\HTTP
 */
interface ResponseInterface
{

    /**
     * @return string
     */
    public function getContent(): string;

}