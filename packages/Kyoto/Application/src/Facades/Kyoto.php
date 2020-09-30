<?php

namespace Kyoto\Application\Facades;

use Illuminate\Support\Facades\Facade;

/** @method static string localize($key) */
class Kyoto extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kyoto';
    }
}
