<?php
namespace Slice\Core\HTTP;

/**
 * Class Request
 * @package Slice\Core\HTTP
 */
class Request
{
    /**
     * @var array
     */
    protected $get = [];

    /**
     * @var array
     */
    protected $post = [];

    /**
     * @var array
     */
    protected $environment = [];

    /**
     * @var array
     */
    protected $cookie = [];

    /**
     * @var array
     */
    protected $server = [];

    /**
     * @var array
     */
    protected $request = [];

    /**
     * Returns Request class with superglobal arrays passed into __construct()
     * @return Request
     */
    public static function createFromGlobals(): Request
    {
        return new self([
            'get' => $_GET,
            'post' => $_POST,
            'cookie' => $_COOKIE,
            'server' => $_SERVER,
            'environment' => $_ENV,
            'request' => $_REQUEST
        ]);
    }

    public function __construct(array $params = [])
    {
        $superglobals = ['get', 'post', 'cookie', 'request', 'server', 'environment'];

        foreach ($superglobals as $key) {
            if (isset($params[$key])) {
                $this->{$key} = $params[$key];
            }
        }

    }

    public function getQueryParameter($key, $default = null)
    {

    }
}