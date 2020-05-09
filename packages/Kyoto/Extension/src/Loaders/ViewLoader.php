<?php

namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class ViewLoader extends LoaderElement
{

    public function bootExtension(ExtensionConfig $config)
    {
        $basePath = str_join('/', $config->path, 'resources/views');

        app('view')->addNamespace($config->name, $basePath);

        return $config;
    }

}
