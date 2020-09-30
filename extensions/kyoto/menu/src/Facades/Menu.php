<?php

namespace Kyoto\Menu\Facades;

use Illuminate\Support\Facades\Facade;

/** @method static array getActiveConfigs() */
class Menu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kyoto.menu';
    }
}
