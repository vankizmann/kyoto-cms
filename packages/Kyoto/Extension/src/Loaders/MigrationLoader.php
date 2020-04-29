<?php

namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class MigrationLoader extends LoaderElement
{

    public function registerExtension(ExtensionConfig $config)
    {
        $path = str_join('/', $config->path, 'database/migrations');

        if ( ! file_exists($path) ) {
            return $config;
        }

        app()->afterResolving('migrator', function ($migrator) use ($path) {
            $migrator->path($path);
        });

        return $config;
    }

}
