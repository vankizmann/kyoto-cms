<?php

namespace Liro\Module\Loaders;

use Liro\Module\Module\Module;

class ExportLoader implements LoaderInterface
{

    public function load(Module $module)
    {
        $path = str_join('/', $module->path, 'exports.php');

        if ( ! file_exists($path) ) {
            return $module;
        }

        app('cms.assets')->export($module->name, include $path);

        return $module;
    }

}
