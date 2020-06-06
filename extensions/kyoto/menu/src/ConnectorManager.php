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

    public function find($key)
    {
        if ( ! isset($this->loaded[$key]) ) {
            return null;
        }

        return $this->loaded[$key];
    }

}
