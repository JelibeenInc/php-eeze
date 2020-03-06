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
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        throw new UndefinedAttribute('Cannot access undefined "' . $key . '" attribute');
    }

    public function set($key, $value)
    {
        return $this->data[$key] = $value;
    }

    public function __get($key)
    {
        return $this->get($key);
    }

    public function __set($key, $value)
    {
        return $this->set($key, $value);
    }

}