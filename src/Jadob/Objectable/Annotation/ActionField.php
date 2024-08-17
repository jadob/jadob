<?php
declare(strict_types=1);

namespace Jadob\Objectable\Annotation;

/**
 * @Annotation
 * @Target({"CLASS"})
 *
 * @TODO: add some constructor
 * @author pizzaminded <miki@calorietool.com>
 * @license MIT
 */
class ActionField
{
    /**
     * Allows to define action name (e.g. edit, delete etc.)
     * This one will be also rendered as a class (prefixed with "objectable-action-" and passed in action button in "data-objectable-action" attribute
     * @var string
     * @Required
     */
    public $name;

    /**
     * URL (or some route name) where user will be redirected on action field click
     * @Required
     * @var string
     */
    public $path;

    /**
     * Value shown as a content of given button
     * @Required
     * @var string
     */
    public $label;

    /**
     * Which value should be passed an value to ActionFieldTransformer?
     * If empty, whole object would be passed
     * @var string
     */
    public $property = 'id';

    /**
     * Name of param that value from ``property`` field will be passed.
     * @var string
     */
    public $key = 'id';
}