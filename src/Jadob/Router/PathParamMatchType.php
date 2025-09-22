<?php

namespace Jadob\Router;

class PathParamMatchType
{
    public const string DEFAULT = '[a-zA-Z0-9\.\_\-]+';

    public const string WILDCARD = '(.*)';
}