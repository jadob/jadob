<?php

namespace Jadob\Cache;

use Jadob\Stdlib\StaticFileUtils;
use Psr\SimpleCache\CacheInterface;


/**
 * Class FileCache
 * @package Jadob\Cache
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FileCache implements CacheInterface
{
    /**
     * @var string
     */
    protected $cacheDir;

    /**
     * FileCache constructor.
     * @param $cacheDir
     */
    public function __construct($cacheDir)
    {
        $this->cacheDir = $cacheDir . '/_app';
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        if (!$this->has($key)) {
            return $default;
        }

        return include $this->cacheDir . '/' . $key . '.php';
    }

    /**
     * Creates cache directory if does not exists.
     */
    private function createAppCacheDirIfNotExists()
    {
        if (!file_exists($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    /**
     * Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time.
     *
     * @param string $key The key of the item to store.
     * @param mixed $value The value of the item to store, must be serializable.
     * @param null|int|\DateInterval $ttl Optional. The TTL value of this item. If no value is sent and
     *                                     the driver supports TTL then the library may set a default value
     *                                     for it or let the driver take care of that.
     *
     * @return bool True on success and false on failure.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *   MUST be thrown if the $key string is not a legal value.
     */
    public function set($key, $value, $ttl = null)
    {
        $this->createAppCacheDirIfNotExists();

        $content = var_export($value, true);
        $content = str_replace("stdClass::__set_state", "(object)", $content);
        $file = '<?php
        //' . $key . ' 
        return ' . $content . ';';

        return (bool)file_put_contents($this->cacheDir . '/' . $key . '.php', $file);
    }

    /**
     * Delete an item from the cache by its unique key.
     *
     * @param string $key The unique cache key of the item to delete.
     *
     * @return bool True if the item was successfully removed. False if there was an error.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *   MUST be thrown if the $key string is not a legal value.
     */
    public function delete($key)
    {
        // TODO: Implement delete() method.
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        StaticFileUtils::recursiveRemoveDirectory($this->cacheDir);
    }

    /**
     * Obtains multiple cache items by their unique keys.
     *
     * @param iterable $keys A list of keys that can obtained in a single operation.
     * @param mixed $default Default value to return for keys that do not exist.
     *
     * @return iterable A list of key => value pairs. Cache keys that do not exist or are stale will have $default as value.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *   MUST be thrown if $keys is neither an array nor a Traversable,
     *   or if any of the $keys are not a legal value.
     */
    public function getMultiple($keys, $default = null)
    {
        // TODO: Implement getMultiple() method.
    }

    /**
     * Persists a set of key => value pairs in the cache, with an optional TTL.
     *
     * @param iterable $values A list of key => value pairs for a multiple-set operation.
     * @param null|int|\DateInterval $ttl Optional. The TTL value of this item. If no value is sent and
     *                                      the driver supports TTL then the library may set a default value
     *                                      for it or let the driver take care of that.
     *
     * @return bool True on success and false on failure.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *   MUST be thrown if $values is neither an array nor a Traversable,
     *   or if any of the $values are not a legal value.
     */
    public function setMultiple($values, $ttl = null)
    {
        // TODO: Implement setMultiple() method.
    }

    /**
     * Deletes multiple cache items in a single operation.
     *
     * @param iterable $keys A list of string-based keys to be deleted.
     *
     * @return bool True if the items were successfully removed. False if there was an error.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *   MUST be thrown if $keys is neither an array nor a Traversable,
     *   or if any of the $keys are not a legal value.
     */
    public function deleteMultiple($keys)
    {
        // TODO: Implement deleteMultiple() method.
    }

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        return file_exists($this->cacheDir . '/' . $key . '.php');
    }
}