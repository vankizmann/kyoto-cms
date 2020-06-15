<?php


namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class BackendLoader extends LoaderElement
{

    public function registerExtension(ExtensionConfig $config)
    {
        if ( ! app('kyoto')->isReady() ) {
            return $config;
        }

        foreach ($config->get('backend', []) as $file) {
            app('kyoto.backend')->addFile($file);
        }

        return $config;
    }

}
