<?php

namespace Jadob\Stdlib;

class StaticFileUtils
{
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