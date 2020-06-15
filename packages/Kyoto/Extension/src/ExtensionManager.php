<?php

namespace Kyoto\Extension;

use Kyoto\Extension\Config\ExtensionConfig;
use Kyoto\Support\Instance\InstanceElement;

class ExtensionManager extends InstanceElement
{

    public $extensionPath = null;

    public $extensionLoaders = [
        Loaders\AutoloadLoader::class,
        Loaders\ServiceProviderLoader::class,
        Loaders\RouteLoader::class,
        Loaders\AssetsLoader::class,
        Loaders\TranslationLoader::class,
        Loaders\ViewLoader::class,
        Loaders\MiddlewareLoader::class,
        Loaders\ConnectorLoader::class,
        Loaders\BackendLoader::class,
    ];

    public $extensionLoad = null;

    public $extensionConfigs = [];

    public $registeredLoaders = [];

    public $registeredConfigs = [];

    public function __construct()
    {
        $this->extensionPath = config('kyoto.extensionPath');
        $this->extensionLoad = config('kyoto.extensionLoad');

        foreach ( $this->extensionLoaders as $loader ) {
            $this->registeredLoaders[] = app()->make($loader);
        }

        parent::__construct();
    }

    public function register()
    {
        $paths = str_join('/', app()->basePath(), $this->extensionPath);

        $this->extensionConfigs = glob($paths);

        foreach ( $this->extensionConfigs as $config ) {
            $this->registeredConfigs[] = new ExtensionConfig($config);
        }

        foreach ( $this->registeredLoaders as $loader ) {
            foreach ( $this->getActiveConfigs() as &$config ) {
                $config = $loader->registerExtension($config);
            }
        }

        parent::register();
    }

    public function boot()
    {
        foreach ( $this->registeredLoaders as $loader ) {
            foreach ( $this->getActiveConfigs() as &$config ) {
                $config = $loader->bootExtension($config);
            }
        }

        parent::boot();
    }

    public function getActiveConfigs()
    {
        return array_filter($this->registeredConfigs, function ($config) {
            return in_array($config->name, $this->extensionLoad);
        });
    }

}
