<?php

namespace Liro\Module\Loaders;

use Liro\Module\Module\Module;

class ViewLoader implements LoaderInterface
{

    public function load(Module $module)
    {
        $basePath = str_join('/', $module->path,
            'resources/views');

        app('view')->addNamespace($module->name,
            $basePath);

        return $module;
    }

}
