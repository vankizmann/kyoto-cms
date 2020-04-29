<?php

namespace Kyoto\Extension\Loaders;

use Kyoto\Extension\Config\ExtensionConfig;

interface LoaderInterface
{
    public function registerExtension(ExtensionConfig $config);

    public function bootExtension(ExtensionConfig $config);
}
