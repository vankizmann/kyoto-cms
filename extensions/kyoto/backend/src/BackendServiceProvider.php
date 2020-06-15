<?php

namespace Kyoto\Backend;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ( ! app('kyoto')->isReady() ) {
            return;
        }

        app()->singleton('kyoto.backend', function () {
            return new BackendManager();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
