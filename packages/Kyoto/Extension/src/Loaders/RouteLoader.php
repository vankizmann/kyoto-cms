<?php

namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class RouteLoader extends LoaderElement
{

    public function bootExtension(ExtensionConfig $config)
    {
        $routePath = str_join('/', $config->path, 'routes.php');

        if ( file_exists($routePath) ) {
            require_once($routePath);
        }

        return $config;
    }

}
