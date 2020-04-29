<?php

namespace Kyoto\Routing\Routers;

use Illuminate\Routing\RouteRegistrar;
use Kyoto\Routing\Reflection\ReflectionElement;
use Kyoto\Routing\Route\RouteElement;

class ControllerRouter implements RouterInterface
{

    public function resolveRoute(RouteElement $url, RouteRegistrar $route)
    {
        $reflection = new ReflectionElement($url);

        if ( empty($parsed = $reflection->getParsed()) ) {
            return null;
        }

        return $route->any($url->getPath(), $parsed);
    }

}
