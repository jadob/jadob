<?php
namespace Jadob\File\Upload;

use Jadob\File\Mime\MimeTypeDetectableInterface;

/**
 * Class SingleFileUploadHandler
 * @author pizzaminded
 */
class SingleFileUploadHandler implements MimeTypeDetectableInterface
{
    /**
     * @var array
     */
    protected $file;

    /**
     * SingleFileUploadHandler constructor.
     * @param array $file
     */
    public function __construct(array $file)
    {
        $this->file = $file;

    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return $this->file['error'] !== UPLOAD_ERR_OK;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->file['type'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->file['name'];
    }

    /**
     * @param string $newLocation
     * @return bool
     */
    public function move(string $newLocation): bool
    {
        return move_uploaded_file($this->file['tmp_name'],$newLocation);
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        $explodedFileName = explode('.', $this->getName());
        return array_pop($explodedFileName);
    }

}