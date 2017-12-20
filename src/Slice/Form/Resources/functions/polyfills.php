<?php
/**
 * This file is kinda of deprecated, but it will be available until i will find some better place for this stuff
 */


/**
 * @param $word
 * @return null|string|string[]
 */
function decamelize($word) {
    return preg_replace(
            '/(^|[a-z])([A-Z])/e', 'strtolower(strlen("\\1") ? "\\1_\\2" : "\\2")', $word
    );
}

function camelize($word) {
    return preg_replace('/(^|_)([a-z])/e', 'strtoupper("\\2")', $word);
}
