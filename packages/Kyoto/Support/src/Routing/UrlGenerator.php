<?php

namespace Kyoto\Support\Routing;

use Kyoto\Routing\Route\RouteHelper;

class UrlGenerator extends \Illuminate\Routing\UrlGenerator
{

    public function to($path, $extra = [], $secure = null)
    {
        $path = RouteHelper::replaceAll($path);

        return parent::to($path, $extra, $secure);
    }

    public function route($name, $parameters = [], $absolute = true)
    {
        $name = RouteHelper::prefixLocale($name);

        return parent::route($name, $parameters, $absolute);
    }

    /**
     * Generate the URL to an application asset.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    public function asset($path, $secure = null)
    {
        return app('kyoto.assets')->file($path, $secure);
    }

}
