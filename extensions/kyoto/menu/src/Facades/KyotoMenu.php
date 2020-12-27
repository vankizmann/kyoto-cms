<?php

namespace Kyoto\Menu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Kyoto\Menu\MenuManager loadMenus()
 * @method static \Kyoto\Menu\MenuManager updateMenus()
 * @method static \Kyoto\Menu\MenuManager clearMenus()
 * @method static array getMenus()
 * @method static \Kyoto\Menu\Models\Menu|null getMenuByUrl(string $url)
 **/
class KyotoMenu extends Facade
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
