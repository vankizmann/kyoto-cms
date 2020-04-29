<?php

namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

class EventLoader extends LoaderElement
{

    public function registerExtension(ExtensionConfig $config)
    {
        foreach ($config->get('events', []) as $event => $handler) {
            app('events')->listen($event, $handler);
        }

        return $config;
    }

}
