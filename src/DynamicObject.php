<?php

namespace Jelibeen\EEZE;

/**
 * Dynamic Object
 *
 * Implements custom functionality to allow dynamic getters and setters
 *
 * @package Jelibeen\EEZE
 */
trait DynamicObject
{

    /**
     * @var array Dynamic properties
     */
    protected $data = [];

    /**
     * Gets a dynamic property
     *
     * @param $key
     * @return mixed
     * @throws UndefinedAttribute if $key is not found
     */
    public function get($key)
    {
        $k = $this->filterKey($key);

        if ($this->has($k)) {
            return $this->data[$k];
        }

        throw new UndefinedAttribute('Cannot access undefined "' . $key . '" attribute');
    }

    /**
     * Determines if this object has a dynamic property
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->data[$this->filterKey($key)]);
    }

    /**
     * Sets a dynamic property
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value)
    {
        return $this->data[$this->filterKey($key)] = $value;
    }

    /**
     * Gets a dynamic property
     *
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Sets a dynamic property
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function __set($key, $value)
    {
        return $this->set($key, $value);
    }

    /**
     * Determines if this object has a dynamic property
     *
     * @param $key
     * @return bool
     */
    public function __isset($key)
    {
        return $this->has($key);
    }

    /**
     * Dynamic methods handler
     *
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        $key    = mb_substr($this->filterKey($method), 3);
        $method = mb_substr($this->filterKey($method), 0, 3);

        if ($method === 'get') {
            return $this->get($key);
        } elseif ($method === 'set') {
            return $this->set($key, count($args) === 1 ? $args[0] : $args);
        }
    }

    /**
     * Retrieves all dynamic properties
     * @return array
     */
    public function getAttributes()
    {
        return $this->data;
    }

    /**
     * Filters a key for consistency
     *
     * @param $key
     * @return string
     */
    private function filterKey($key)
    {
        return trim(strtolower($key));
    }

}
