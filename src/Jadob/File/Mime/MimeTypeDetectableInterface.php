<?php

namespace Jadob\File\Mime;

/**
 * Interface MimeTypeDetectableInterface
 * @package Jadob\File\Mime
 */
interface MimeTypeDetectableInterface
{
    /**
     * @return string
     */
    public function getMimeType(): string;
}