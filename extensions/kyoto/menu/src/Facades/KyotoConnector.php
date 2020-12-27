<?php

namespace Kyoto\Menu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void add(string $key, string $connector)
 * @method static \Kyoto\Menu\Connectors\ConnectorInterface find(string $key)
 * @method static array keys()
 */
class KyotoConnector extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'kyoto.connector';
    }
}
