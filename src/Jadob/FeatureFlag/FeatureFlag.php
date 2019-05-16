<?php

namespace Jadob\FeatureFlag;

/**
 * Allows to enable/disable features in app depending on passed conditions.
 *
 * How does config array should look like:
 *
 * 'feature_name' => [
 *      'enabled' => true|false,
 *      'request' => [
 *          'host' => string|string[],
 *          'method'  => string|string[],
 *          'ip' => string|string[]
 *      ],
 *      'user' => [
 *          'id' => int|int[],
 *          'username' => string|string[],
 *          'role' => string|string[]
 *      ]
 * ]
 *
 *
 * @see https://martinfowler.com/articles/feature-toggles.html
 * @package Jadob\FeatureFlag
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FeatureFlag
{

    public static function isEnabled($name)
    {

    }
}