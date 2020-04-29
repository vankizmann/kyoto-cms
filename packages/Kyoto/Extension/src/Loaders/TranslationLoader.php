<?php

namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class TranslationLoader extends LoaderElement
{
    public function registerExtension(ExtensionConfig $config)
    {
        $path = str_join('/', $config->path, 'resources/lang');

        if ( ! file_exists($path) ) {
            return $config;
        }

        app('translator')->addNamespace($config->name, $path);

        return $config;
    }

}
