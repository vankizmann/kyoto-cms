<?php

namespace Kyoto\Assets;

use Illuminate\Support\ServiceProvider;

class AssetsServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('kyoto.assets', function () {
            return new AssetsManager();
        });

        app('kyoto.assets')->register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('kyoto.assets')->boot();
    }

}
