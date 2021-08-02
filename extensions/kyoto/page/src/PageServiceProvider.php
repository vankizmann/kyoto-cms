<?php

namespace Kyoto\Page;

use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
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

        app()->singleton('kyoto.widget', function () {
            return new WidgetManager();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ( ! app('kyoto')->isReady() ) {
            return;
        }

        app('kyoto.widget')->getWidgets();
        //
    }

}
