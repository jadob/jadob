<?php

namespace Jadob\Stdlib;

/**
 * Class StaticFileUtils
 * @package Jadob\Stdlib
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class StaticFileUtils
{
    /**
     * @param string $path to directory that need to be removed
     */
    public static function recursiveRemoveDirectory($path)
    {
        if (!file_exists($path)) {
            return;
        }

        if (is_dir($path)) {
            array_map([__CLASS__, 'recursiveRemoveDirectory'], glob($path . DIRECTORY_SEPARATOR . '{,.[!.]}*', GLOB_BRACE));
            @rmdir($path);
        } else {
            @unlink($path);
        }
    }

}