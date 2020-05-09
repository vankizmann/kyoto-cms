<?php

namespace Kyoto\Application\Plugins;

use Illuminate\Support\Collection;
use Kyoto\Support\Collection\CollectionMacros;

trait CollectionPlugin
{

    /**
     * Register collection plugin
     *
     * @throws \Exception
     * @return void
     */
    public function registerCollectionPlugin()
    {
        Collection::mixin(new CollectionMacros);
    }

}
