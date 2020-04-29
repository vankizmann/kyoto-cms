<?php

namespace Kyoto\Extension;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('kyoto.extension', function () {
            return new ExtensionInstance();
        });

        app('kyoto.extension')->register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('kyoto.extension')->boot();
    }

}
