<?php

namespace Jelibeen\EEZE;

/**
 *
 * @package Jelibeen\EEZE
 */
trait DynamicObject
{

    protected $data = [];

    public function get($key)
    {
        $k = $this->filterKey($key);

        if (isset($this->data[$k])) {
            return $this->data[$k];
        }

        throw new UndefinedAttribute('Cannot access undefined "' . $key . '" attribute');
    }

    public function set($key, $value)
    {
        return $this->data[$this->filterKey($key)] = $value;
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    public function __set($key, $value)
    {
        return $this->set($key, $value);
    }

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

    private function filterKey($key)
    {
        return trim(strtolower($key));
    }

}