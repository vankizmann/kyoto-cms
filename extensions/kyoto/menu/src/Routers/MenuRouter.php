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

        $menu = app('kyoto.menu')->getMenuByUrl();

        $login = app('kyoto.user')->unguarded(function () {

            $baseMenu = app('kyoto.menu')->getMenuByUrl();

            if ( ! $baseMenu ) {
                return null;
            }

            return $baseMenu->getLogin();
        });

        if ( $login && ! $menu ) {
            header('Location: ' . url($login->path));
            exit;
        }

        if ( ! $menu ) {
            return $login ?  : null;
        }

        app('kyoto')->setMenu($menu);

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
