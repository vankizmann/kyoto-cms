<?php

namespace Kyoto\Menu\Routers;

use Illuminate\Routing\RouteRegistrar;
use Kyoto\Routing\Route\RouteElement;
use Kyoto\Routing\Route\RouteHelper;
use Kyoto\Routing\Routers\RouterInterface;

class MenuRouter implements RouterInterface
{

    public function resolveRoute(RouteElement $url, RouteRegistrar $route)
    {
        if ( ! app('kyoto')->isReady() ) {
            return null;
        }

        $menu = app('kyoto.menu')->getMenuByUrl();

        if ( ! $menu ) {
            return $this->notFound();
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

    public function notFound()
    {
        $login = app('kyoto.user')->unguarded(function () {

            $baseMenu = app('kyoto.menu')->getMenuByUrl();

            if ( ! $baseMenu ) {
                return null;
            }

            return $baseMenu->getLogin();
        });

        if ( ! $login ) {
            return null;
        }

        $query = [
            'redirect' => RouteHelper::getPath()
        ];

        redirect()->to(RouteHelper::withQuery(url($login->path), $query))->send();
    }

}
