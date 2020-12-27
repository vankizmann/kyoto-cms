<?php

namespace Kyoto\Extension\Loaders;

use Illuminate\Translation\Translator;
use Kyoto\Extension\Config\ExtensionConfig;

class TranslationLoader extends LoaderElement
{

    public function bootExtension(ExtensionConfig $config)
    {
        $path = str_join('/', $config->path, 'resources/lang');

        if ( ! file_exists($path) ) {
            return $config;
        }

        app('translator')->addNamespace($config->name, $path);

        return $config;
    }

}
