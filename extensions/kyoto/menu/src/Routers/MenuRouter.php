<?php

namespace Kyoto\Menu\Routers;

use Kyoto\Application\Facades\Kyoto;
use Kyoto\Menu\Facades\KyotoMenu;
use Kyoto\Menu\Facades\KyotoConnector;
use Kyoto\User\Facades\KyotoUser;
use Kyoto\Routing\Route\RouteHelper;
use Kyoto\Routing\Route\RouteElement;
use Illuminate\Routing\RouteRegistrar;
use Kyoto\Routing\Routers\RouterInterface;

class MenuRouter implements RouterInterface
{

    public function resolveRoute(RouteElement $url, RouteRegistrar $route)
    {
        if ( ! Kyoto::isReady() ) {
            return null;
        }

        $menu = KyotoMenu::getMenuByUrl();

        if ( ! $menu ) {
            return $this->notFound();
        }

        Kyoto::setMenu($menu);

        /** @var \Kyoto\Menu\Connectors\ConnectorInterface $connector */
        $connector = KyotoConnector::find($menu['type']);

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
        $login = KyotoUser::unguarded(function () {

            $baseMenu = KyotoMenu::getMenuByUrl();

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
