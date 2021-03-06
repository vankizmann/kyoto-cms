<?php

namespace Kyoto\Support\Instance;

class InstanceElement
{
    public function __construct()
    {
        //
    }

    public function register()
    {
        foreach ( class_uses_recursive(static::class) as $trait ) {
            $this->registerTrait($trait);
        }
    }

    public function boot()
    {
        foreach ( class_uses_recursive(static::class) as $trait ) {
            $this->bootTrait($trait);
        }
    }

    public function registerTrait($trait)
    {
        $registerMethod = 'register' . class_basename($trait);

        if ( ! method_exists($this, $registerMethod) ) {
            return;
        }

        app()->call([$this, $registerMethod]);
    }

    public function bootTrait($trait)
    {
        $bootMethod = 'boot' . class_basename($trait);

        if ( ! method_exists($this, $bootMethod) ) {
            return;
        }

        app()->call([$this, $bootMethod]);
    }

}
