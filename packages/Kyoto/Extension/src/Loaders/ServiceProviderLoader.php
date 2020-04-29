<?php

namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class ServiceProviderLoader extends LoaderElement
{

    public function registerExtension(ExtensionConfig $config)
    {
        foreach ($config->get('providers', []) as $provider) {
            app()->register($provider);
        }

        return $config;
    }

}
