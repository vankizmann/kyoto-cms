<?php

namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class AssetsLoader extends LoaderElement
{

    public function bootExtension(ExtensionConfig $config)
    {
        $manifest = str_join('/', $config->path, 'mix-manifest.json');

        if ( file_exists($manifest) ) {

            $manifestBody = file_get_contents($manifest);

            foreach ( json_decode($manifestBody) as $source => $target) {

                $source = $config->name . '::' . preg_replace('#/public/#', '', $source);
                $target = $config->name . '::' . preg_replace('#/public/#', '', $target);

                app('kyoto.assets')->addManifest($source, $target);
            }
        }

        $publicPath = public_path("extensions/{$config->name}");

        if ( ! file_exists($publicPath) && file_exists("{$config->path}/public") ) {
            $this->linkRecursive("{$config->path}/public", $publicPath);
        }

        app('kyoto.assets')->addNamespace($config->name, $publicPath);

        return $config;
    }

    public function linkRecursive($path, $publicPath)
    {
        if ( ! file_exists($path) || file_exists($publicPath) ) {
            return;
        }

        if ( ! file_exists(dirname($publicPath)) ) {
            app()->make('files')->makeDirectory(dirname($publicPath), 0755, true);
        }

        app()->make('files')->link($path, $publicPath);
    }

}
