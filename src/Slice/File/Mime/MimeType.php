<?php
use Slice\File\Mime\MimeTypeDetectableInterface;


/**
 * Class MimeType
 */
class MimeType
{
    /**
     * @param MimeTypeDetectableInterface $resource
     * @return bool
     */
    public function isImage($resource): bool
    {
        $mime = null;
        if (is_object($resource) && in_array(MimeTypeDetectableInterface::class, class_implements($resource), true)) {
            /** @var Slice\File\Mime\MimeTypeDetectableInterface $resource */
            $mime = $resource->getMimeType();
        }

        return in_array($mime, [
            'image/jpeg',
            'image/gif',
            'image/png',
            'image/bmp'
        ], true);
    }


}