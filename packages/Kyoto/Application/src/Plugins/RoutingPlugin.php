<?php

namespace Kyoto\Application\Plugins;

use Kyoto\Support\Routing\UrlGenerator;

trait RoutingPlugin
{

    /**
     * Register collection plugin
     *
     * @return void
     */
    public function registerRoutingPlugin()
    {
        app()->extend('url', function () {
            return new UrlGenerator(app('routes'), app('request'));
        });
    }

}
