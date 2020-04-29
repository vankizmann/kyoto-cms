<?php

namespace Liro\Module\Loaders;

use Liro\Module\Module\Module;

class RouteLoader implements LoaderInterface
{

    public function load(Module $module)
    {
        foreach ( $module->get('routes', []) as $key => $options ) {
            app('web.menu')->registerRoute($key, $options);
        }

        return $module;
    }

}
