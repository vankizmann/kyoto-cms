<?php

namespace Kyoto\Menu;

class ConnectorManager
{

    public $loaded = [
        //
    ];

    public function add($key, $connector)
    {
        $this->loaded[$key] = new $connector;
    }

    public function has($key)
    {
        return ! empty($this->loaded[$key]);
    }

    public function find($key)
    {
        if ( ! isset($this->loaded[$key]) ) {
            return null;
        }

        return $this->loaded[$key];
    }

    public function keys()
    {
        return array_keys($this->loaded);
    }

}
