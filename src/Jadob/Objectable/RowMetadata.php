<?php

declare(strict_types=1);

namespace Jadob\Objectable;

use Jadob\Objectable\Annotation\ActionField;
use Jadob\Objectable\Annotation\Header;

/**
 * @internal This class should not be used outside of Jadob\Objectable package.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
final class RowMetadata
{
    /**
     * @var Header[]
     */
    protected $headers = [];

    /**
     * @var ActionField[]
     */
    protected $actionFields = [];

    /**
     * @return Header[]
     */
    public function getHeaders(): array
    {
        $output = $this->headers;

        if (count($this->actionFields) > 0) {
            $actionFieldHeader = new Header();
            $actionFieldHeader->order = 100000;
            $actionFieldHeader->title = 'objectable.headers';

            $output['objectable.headers'] = $actionFieldHeader;
        }

        return $output;
    }

    /**
     * @param Header[] $headers
     * @return RowMetadata
     */
    public function setHeaders(array $headers): RowMetadata
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getPropertiesToExtract(): array
    {
        return array_keys($this->headers);
    }

    /**
     * @return ActionField[]
     */
    public function getActionFields(): array
    {
        return $this->actionFields;
    }

    /**
     * @param ActionField[] $actionFields
     * @return RowMetadata
     */
    public function setActionFields(array $actionFields): RowMetadata
    {
        $this->actionFields = $actionFields;
        return $this;
    }
}