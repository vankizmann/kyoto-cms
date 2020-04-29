<?php

namespace Kyoto\Routing;

use Illuminate\Foundation\Application;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Router;
use Kyoto\Routing\Route\RouteElement;

class InflectedRouter extends Controller
{
    public const ROUTER_ACTION = [
        self::class, 'resolveInflectedRoute'
    ];

    public static $routeInflectors = [
        //
    ];

    public static $loadedInflectors = [
        //
    ];

    public function __construct()
    {
        self::$routeInflectors = config('kyoto.routeInflectors');
    }

    public static function setRouteInflectors($inflectors)
    {
        self::$routeInflectors = $inflectors;
    }

    public static function appendRouteInflectors($inflectors)
    {
        array_push(self::$routeInflectors, $inflectors);
    }

    public static function prependRouteInflectors($inflectors)
    {
        array_unshift(self::$routeInflectors, $inflectors);
    }

    public function bootInflectors()
    {
        foreach ( self::$routeInflectors as $inflector ) {
            self::$loadedInflectors[$inflector] = app()->make($inflector);
        }
    }

    public function resolveInflectedRoute(Application $application, Router $router)
    {
        /** @var \Illuminate\Routing\Route $routeAction */
        $routeAction = null;

        $this->bootInflectors();

        foreach ( self::$loadedInflectors as $inflector ) {
            if ( ! $routeAction ) {
                $routeAction = $inflector->resolveRoute(new RouteElement, $router->as('InflectedRoute'));
            }
        }

        if ( empty($routeAction) ) {
            $application->abort(404);
        }

        return $router->respondWithRoute($routeAction->getName());
    }
}
