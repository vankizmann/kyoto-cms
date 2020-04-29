<?php

namespace Kyoto\Routing\Routers;

use Illuminate\Routing\RouteRegistrar;
use Kyoto\Routing\Route\RouteElement;

interface RouterInterface
{
    public function resolveRoute(RouteElement $url, RouteRegistrar $route);
}
