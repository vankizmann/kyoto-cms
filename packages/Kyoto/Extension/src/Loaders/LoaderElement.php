<?php


namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class LoaderElement implements LoaderInterface
{

    public function registerExtension(ExtensionConfig $config)
    {
        return $config;
    }

    public function bootExtension(ExtensionConfig $config)
    {
        return $config;
    }

}
