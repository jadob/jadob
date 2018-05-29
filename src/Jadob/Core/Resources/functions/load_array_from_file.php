<?php

/**
 * This one allows to load configuration from file and separates the scope.
 * @param $path
 * @param array $params
 * @return array
 */
function load_array_from_file($path, $params = [])
{
    extract($params, EXTR_OVERWRITE);

    return include $path;

}