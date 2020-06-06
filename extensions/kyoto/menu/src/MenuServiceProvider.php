<?php

namespace Kyoto\Menu;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton('kyoto.connector', function () {
            return new ConnectorManager();
        });

        if ( ! app('kyoto')->isReady() ) {
            return;
        }

        app()->singleton('kyoto.menu', function () {
            return new MenuManager();
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
