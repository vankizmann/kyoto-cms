<?php

namespace Kyoto\Support\Mapper;

use ArrayAccess;
use Illuminate\Support\Arr;

abstract class DataMapper implements ArrayAccess
{
    public $data = [];

    public function __exists($key)
    {
        return Arr::has($this->data, $key);
    }

    public function __get($key)
    {
        return Arr::get($this->data, $key);
    }

    public function __set($key, $value)
    {
        return Arr::set($this->data, $key, $value);
    }

    public function __unset($key)
    {
        Arr::forget($this->data, $key);
    }

    public function offsetExists($key)
    {
        return $this->__exists($key);
    }

    public function offsetGet($key)
    {
        return $this->__get($key);
    }

    public function offsetSet($key, $value)
    {
        return $this->__set($key, $value);
    }

    public function offsetUnset($key)
    {
        return $this->__unset($key);
    }

    public function get($key, $fallback = null)
    {
        return Arr::get($this->data, $key, $fallback);
    }

    public function set($key, $value)
    {
        return Arr::set($this->data, $key, $value);
    }

    public function has($key)
    {
        return Arr::has($this->data, $key);
    }

}
