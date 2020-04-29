<?php

namespace Kyoto\Extension;

use Kyoto\Extension\Config\ExtensionConfig;
use Kyoto\Support\Instance\InstanceElement;

class ExtensionInstance extends InstanceElement
{

    public $extensionPath = null;

    public $extensionLoaders = [
        Loaders\AutoloadLoader::class,
        Loaders\ServiceProviderLoader::class,
        Loaders\MigrationLoader::class,
        Loaders\MiddlewareLoader::class,
        Loaders\TranslationLoader::class,
    ];

    public $extensionAutoload = null;

    public $extensionConfigs = [];

    public $registeredLoaders = [];

    public $registeredConfigs = [];

    public function __construct()
    {
        $this->extensionPath = config('kyoto.extensionPath');
        $this->extensionAutoload = config('kyoto.extensionAutoload');

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
            foreach ( $this->registeredConfigs as &$config ) {
                $config = $loader->registerExtension($config);
            }
        }

        parent::register();
    }

    public function boot()
    {
        foreach ( $this->registeredLoaders as $loader ) {
            foreach ( $this->registeredConfigs as &$config ) {
                $config = $loader->bootExtension($config);
            }
        }

        parent::boot();
    }

}
