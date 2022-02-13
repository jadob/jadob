<?php
declare(strict_types=1);

namespace Jadob\Objectable\Annotation;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 * @deprecated use Field instead.
 *
 * @author pizzaminded <miki@calorietool.com>
 * @license MIT
 */
class Header
{
    /**
     * @Required
     * @var string
     */
    public $title;

    /**
     * @Required
     * @var int
     */
    public $order;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return int|null
     */
    public function getOrder(): ?int
    {
        return $this->order;
    }
}