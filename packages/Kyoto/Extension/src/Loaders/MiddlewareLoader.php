<?php

namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class MiddlewareLoader extends LoaderElement
{

    public function bootExtension(ExtensionConfig $config)
    {
        foreach ($config->get('middleware', []) as $name => $handler) {
            app('router')->aliasMiddleware($name, $handler);
        }

        return $config;
    }

}
