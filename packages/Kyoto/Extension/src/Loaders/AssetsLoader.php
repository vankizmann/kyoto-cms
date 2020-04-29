<?php

namespace Liro\Module\Loaders;

use Liro\Module\Module\Module;

class AssetsLoader implements LoaderInterface
{

    public function load(Module $module)
    {
        $manifest = str_join('/', $module->path, 'mix-manifest.json');

        if ( file_exists($manifest) ) {

            $manifestBody = file_get_contents($manifest);

            foreach ( json_decode($manifestBody) as $source => $target) {

                $source = $module->name . '::' . preg_replace('#/public/#', '', $source);
                $target = $module->name . '::' . preg_replace('#/public/#', '', $target);

                app('web.assets')->addManifest($source, $target);
            }
        }

        $publicPath = public_path("web/{$module->name}");

        if ( ! file_exists($publicPath) && file_exists("{$module->path}/public") ) {
            app()->make('files')->link("{$module->path}/public", $publicPath);
        }

        app('web.assets')->addNamespace($module->name, $publicPath);

        foreach ( $module->get('imports', []) as $extension => $imports ) {
            app('web.assets')->export($extension, $imports);
        }

        return $module;
    }

}
