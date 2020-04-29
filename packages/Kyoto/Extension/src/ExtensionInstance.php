<?php

namespace Kyoto\Extension;

use Kyoto\Support\InstanceInitializer;

class ExtensionInstance extends InstanceInitializer
{

    public $extensionPath = null;

    public $extensionLoaders = [];

    public $extensionAutoload = null;

    public $extensionConfigs = [];

    public function __construct()
    {
        $this->extensionPath = config('kyoto.extensionPath');
        $this->extensionAutoload = config('kyoto.extensionAutoload');

        parent::__construct();
    }

    public function initialize()
    {
        $paths = str_join('/', app()->basePath(), $this->extensionPath);

        $this->extensionConfigs = glob($paths);
    }

    public function boot()
    {
        parent::boot();


    }

}
