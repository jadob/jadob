<?php

namespace Slice\File\Mime;

interface MimeTypeDetectableInterface
{
    /**
     * @return string
     */
    public function getMimeType(): string;
}