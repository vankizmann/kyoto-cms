<?php

namespace Kyoto\Extension\Facades;

use Illuminate\Support\Facades\Facade;

/** @method static array getActiveConfigs() */
class Extension extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kyoto.extension';
    }
}
