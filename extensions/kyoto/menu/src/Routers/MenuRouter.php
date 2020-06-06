<?php

namespace Kyoto\Menu\Routers;

use Illuminate\Routing\RouteRegistrar;
use Kyoto\Routing\Route\RouteElement;
use Kyoto\Routing\Routers\RouterInterface;

class MenuRouter implements RouterInterface
{

    public function resolveRoute(RouteElement $url, RouteRegistrar $route)
    {
        if ( ! app('kyoto')->isReady() ) {
            return null;
        }

        $menu = app('kyoto.menu')->findByUrl();

        if ( ! $menu ) {
            return null;
        }

        /** @var \Kyoto\Menu\Connectors\ConnectorInterface $connector */
        $connector = app('kyoto.connector')->find($menu['type']);

        if ( ! $connector ) {
            return null;
        }

        $options = $connector->route($menu);

        if ( ! $options ) {
            return null;
        }

        return $route->any($url->getPath(), $options);
    }

}
