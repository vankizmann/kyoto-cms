<?php


namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class ConnectorLoader extends LoaderElement
{

    public function registerExtension(ExtensionConfig $config)
    {
        foreach ($config->get('connectors', []) as $key => $connector) {
            app('kyoto.connector')->add("{$config->name}::{$key}", $connector);
        }

        return $config;
    }

}
