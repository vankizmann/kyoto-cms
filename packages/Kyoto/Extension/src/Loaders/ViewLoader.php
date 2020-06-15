<?php

namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class ViewLoader extends LoaderElement
{

    public function bootExtension(ExtensionConfig $config)
    {
        app('view')->addNamespace($config->name,
            str_join('/', $config->path, 'resources/views'));

        return $config;
    }

}
