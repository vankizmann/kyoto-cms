<?php


namespace Kyoto\Extension\Loaders;

use Composer\Autoload\ClassLoader;
use Kyoto\Extension\Config\ExtensionConfig;

class AutoloadLoader extends LoaderElement
{
    protected $loader;

    public function __construct()
    {
        $this->loader = new ClassLoader();
    }

    public function registerExtension(ExtensionConfig $config)
    {
        foreach ($config->get('autoload', []) as $namespace => $hint) {
            $this->loader->addPsr4($namespace, $config->path . '/' . $hint);
        }

        $this->loader->register();

        return $config;
    }

}
