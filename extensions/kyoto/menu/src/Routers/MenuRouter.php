<?php

namespace Kyoto\Menu\Routers;

use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\DB;
use Kyoto\Menu\Models\Menu;
use Kyoto\Routing\Route\RouteElement;
use Kyoto\Routing\Routers\RouterInterface;

class MenuRouter implements RouterInterface
{

    public function resolveRoute(RouteElement $url, RouteRegistrar $route)
    {
        $menu = Menu::where(DB::raw("REPLACE(path , '{locale}', '" . app()->getLocale() . "')"), $url->getPath())->first();

        if ( ! $menu ) {
            return null;
        }

        dd($url->getPath());

        return $route->any($url->getPath(), 'Kyoto\\Menu\\Http\\Controllers\\MenuController@index');
    }

}
